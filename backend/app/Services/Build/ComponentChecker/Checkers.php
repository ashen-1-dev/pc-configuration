<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\CheckerResult;
use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Services\Build\MotherboardFormFactor;
use App\Services\Build\PowerSupplyFormFactor;

class Checkers
{
    private const CHECKERS = [
        'ram' => RAMChecker::class,
        'gpu' => GPUChecker::class,
        'motherboard' => MotherboardChecker::class,
        'case' => CaseChecker::class,
        'powersupply' => PowerSupplyChecker::class,
        'cpu' => CPUChecker::class,
    ];

    /**
     * @param string $type
     * @return string|null
     */
    public static function getChecker(string $type): string|null
    {
        if (isset(self::CHECKERS[$type])) {
            return self::CHECKERS[$type];
        }
        return null;
    }

    public static function checkRAMWithMotherboard(GetComponentDto $ram, GetComponentDto $motherboard): CheckerResult
    {
        $ramMemoryType = $ram->attributes->where('name', '=', 'memory_type')->first()->value;
        $motherboardMemoryType = $motherboard->attributes->where('name', '=', 'memory_type')->first()->value;
        $checkerResult = new CheckerResult(isCompatible: true, message: '');
        if ($motherboardMemoryType != $ramMemoryType) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'У ОЗУ и мат.платы не совпадают типы памяти.';
        }

        $ramAmountOfModules = $ram->attributes->where('name', '=', 'number_of_modules')->first()->value;
        $motherboardAmountOfRAM = $motherboard->attributes->where('name', '=', 'memory_slots')->first()->value;

        if ($ramAmountOfModules > $motherboardAmountOfRAM) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Недостаточно слотов для оперативной памяти';
        }

        return $checkerResult;
    }

    public static function checkGPUWithCase(GetComponentDto $gpu, GetComponentDto $case): CheckerResult
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');

        $gpuLength = $gpu->attributes->where('name', '=', 'gpu_length')->first()->value;
        $maxGpuLengthInCase = $case->attributes->where('name', '=', 'max_gpu_length')->first()->value;

        if ($gpuLength > $maxGpuLengthInCase) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Видеокарте недостаточно места для данного корпуса';
        }

        return $checkerResult;
    }

    public static function checkGPUWithMotherboard(GetComponentDto $gpu, GetComponentDto $motherboard)
    {
        //FIXME: Спросить у научрука как лучше поступить
    }


    public static function checkGPUWithPowerSupply(GetComponentDto $gpu, GetComponentDto $powersupply): CheckerResult
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');

        $gpuPower = $gpu->attributes->where('name', '=', 'pcie6pin')->first();

        if (isset($gpuPower)) {
            $powersupplyConnector = $powersupply->attributes->where('name', '=', 'pcie6pin')->first();
            if (!isset($powersupplyConnector) || !($powersupplyConnector->value >= $gpuPower->value)) {
                $checkerResult->isCompatible = false;
                $checkerResult->message = 'Недостаточно кабелей питания для видеокарты';
            }
        }

        $gpuPower = $gpu->attributes->where('name', 'pcie8pin')->first();

        if (isset($gpuPower)) {
            $powersupplyConnector = $powersupply->attributes->where('name', '=', 'pcie8pin')->first();
            if (!isset($powersupplyConnector) || !($powersupplyConnector->value >= $gpuPower->value)) {
                $checkerResult->isCompatible = false;
                $checkerResult->message = 'Недостаточно кабелей питания для видеокарты';
            }
        }
        return $checkerResult;
    }

    public static function checkCPUWithMotherboard(GetComponentDto $cpu, GetComponentDto $motherboard): CheckerResult
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');

        $cpuSocket = $cpu->attributes->where('name', '=', 'socket')->first()->value;
        $motherboardCpuSocket = $motherboard->attributes->where('name', '=', 'socket')->first()->value;

        if ($cpuSocket != $motherboardCpuSocket) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Процессор несовместим с мат. платой';
        }

        return $checkerResult;
    }

    public static function checkWithCPUWithCPUCooler(GetComponentDto $cpu, GetComponentDto $cpuCooler): CheckerResult
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');
        $cpuSocket = $cpu->attributes->where('name', '=', 'socket')->first()->value;
        $cpuCoolerSocket = $cpuCooler->attributes->where('name', '=', 'socket')->first()->value;
        //FIXME: сокеты, которые поддерживает кулер, может быть несколько
        if ($cpuSocket != $cpuCoolerSocket) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Сокеты процесса и процессорного охлаждения несовместимы';
        }

        return $checkerResult;
    }

    public static function checkCaseWithMotherboard(GetComponentDto $case, GetComponentDto $motherboard): CheckerResult
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');
        if (!self::checkFormFactorBetweenCaseAndMotherboard($case, $motherboard)) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Мат. плата и корпус имеют разные форм-факторы';
        }

        return $checkerResult;
    }

    public static function checkCaseWithCPUCooler(GetComponentDto $case, GetComponentDto $cpuCooler): CheckerResult
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');

        $maxCPUCoolerHeight = $case->attributes->where('name', '=', 'max_cpu_cooler_height')->first()->value;
        $cpuCoolerHeight = $cpuCooler->attributes->where('name', '=', 'height')->first()->value;

        if ($cpuCoolerHeight > $maxCPUCoolerHeight) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Неподходящие габариты процессорного кулера и корпуса';
        }
        return $checkerResult;
    }

    public static function checkPowerSupplyWithMotherboard(GetComponentDto $ps, GetComponentDto $motherboard)
    {
        $checkerResult = new CheckerResult(isCompatible: true, message: '');
        if (!self::checkFormFactorBetweenPowerSupplyAndMotherboard($ps, $motherboard)) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Блок питания и мат. плата имеют несовместимые форм-факторы';
        }

        $powerSupplyMainSocket = $ps->attributes->where('name', '=', 'main_socket')->first()->value;
        $motherboardSocket = $motherboard->attributes->where('name', '=', 'power_supply_main_socket')->first()->value;

        if ($powerSupplyMainSocket != $motherboardSocket) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Не подходит основной кабель питания мат. платы';
        }

        $powerSupplyCPUSocket = $ps->attributes->where('name', '=', 'cpu_power_socket')->first()->value;
        $motherboardCPUPowerSocket = $motherboard->attributes->where('name', '=', 'cpu_power_socket')->first()->value;

        if ($powerSupplyCPUSocket != $motherboardCPUPowerSocket) {
            $checkerResult->isCompatible = false;
            $checkerResult->message = 'Не подходит  кабель питания процессора в мат. плате';
        }

        return $checkerResult;
    }

    private static function checkFormFactorBetweenPowerSupplyAndMotherboard(
        GetComponentDto $ps,
        GetComponentDto $motherboard
    ): bool
    {
        $powerSupplyFormFactor = $ps
            ->attributes
            ->where('name', '=', 'form_factor')
            ->first()
            ->value;
        $motherboardFormFactor = $motherboard
            ->attributes
            ->where('name', '=', 'power_supply_form_factor')
            ->first()
            ->value;
        $powerSupplySizes = PowerSupplyFormFactor::getValue($powerSupplyFormFactor);
        $motherboardPowerSupplySizes = PowerSupplyFormFactor::getValue($motherboardFormFactor);

        $isLengthFit = $motherboardPowerSupplySizes['length'] >= $powerSupplySizes['height'];
        $isWidthFit = $motherboardPowerSupplySizes['width'] >= $powerSupplySizes['width'];
        $isHeightFit = $motherboardPowerSupplySizes['height'] >= $powerSupplySizes['height'];

        if ($isHeightFit && $isLengthFit && $isWidthFit) {
            return true;
        }

        return false;
    }

    private static function checkFormFactorBetweenCaseAndMotherboard(
        GetComponentDto $case,
        GetComponentDto $motherboard
    ): bool
    {
        $caseFormFactor = $case
            ->attributes
            ->where('name', '=', 'motherboard_form_factor')
            ->first()
            ->value;
        $motherboardFormFactor = $motherboard
            ->attributes
            ->where('name', '=', 'form_factor')
            ->first()
            ->value;
        $caseSize = MotherboardFormFactor::getValue($caseFormFactor);
        $motherboardSize = MotherboardFormFactor::getValue($motherboardFormFactor);

        $isLengthFit = $motherboardSize['length'] >= $caseSize['length'];
        $isWidthFit = $motherboardSize['width'] >= $caseSize['width'];

        if ($isLengthFit && $isWidthFit) {
            return true;
        }

        return false;
    }
}
