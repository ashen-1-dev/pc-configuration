<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Services\Build\PowerSupplyFormFactor;

class Checkers
{
    private const CHECKERS = [
        'ram' => RAMChecker::class,
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

    public static function checkRamWithMotherboard(GetComponentDto $ram, GetComponentDto $motherboard)
    {
        $RAMAttribute = $ram->attributes->where('name', '=', 'memory_type')->first()->value;
        $motherboardAttribute = $motherboard->attributes->where('name', '=', 'memory_type')->first()->value;
        if ($motherboardAttribute == $RAMAttribute) {
            return ['compatible' => true, 'message' => ''];
        }
        return [
            'compatible' => false,
            'message' => 'У ОЗУ и мат.платы не совпадают типы памяти.'
        ];
    }

    public static function checkGPUWithCase(GetComponentDto $gpu, GetComponentDto $case)
    {
        $gpuLength = $gpu->attributes->where('name', 'gpu_length')->first()->value;
        $maxGpuLengthInCase = $case->attributes->where('name', 'max_gpu_length')->first()->value;

        if ($gpuLength <= $maxGpuLengthInCase) {
            return ['compatible' => true, 'message' => ''];
        }

        return ['compatible' => false, 'message' => 'Видеокарте недостаточно места для данного корпуса'];
    }

    public static function checkGPUWithMotherboard(GetComponentDto $gpu, GetComponentDto $motherboard)
    {
        //FIXME: Спросить у научрука как лучше поступить
    }


    public static function checkGPUWithPowerSupply(GetComponentDto $gpu, GetComponentDto $powersupply)
    {
        $gpuPower = $gpu->attributes->where('name', 'pcie6pin')->first();
        $error = ['compatible' => false, 'message' => 'Недостаточно кабелей питания для видеокарты'];
        if (isset($gpuPower)) {
            $powersupplyConnector = $powersupply->attributes->where('name', 'pcie6pin')->first();
            if (!isset($powersupplyConnector) || !($powersupplyConnector->value >= $gpuPower->value)) {
                return $error;
            }
        }

        $gpuPower = $gpu->attributes->where('name', 'pcie8pin')->first();

        if (isset($gpuPower)) {
            $powersupplyConnector = $powersupply->attributes->where('name', 'pcie8pin')->first();
            if (!isset($powersupplyConnector) || !($powersupplyConnector->value >= $gpuPower->value)) {
                return $error;
            }
        }
        return ['compatible' => true, 'message'];
    }

    public static function checkCPUWithMotherboard(GetComponentDto $cpu, GetComponentDto $motherboard)
    {
        $cpuSocket = $cpu->attributes->where('name', 'socket')->first()->value;
        $motherboardCpuSocket = $motherboard->attributes->where('name', 'socket')->first()->value;

        if ($cpuSocket == $motherboardCpuSocket) {
            return ['compatible' => true, 'message' => ''];
        }

        return ['compatible' => false, 'message' => 'Процессор несовместим с мат. платой'];
    }

    public static function checkWithCPUWithCPUCooler(GetComponentDto $cpu, GetComponentDto $cpuCooler)
    {
        $cpuSocket = $cpu->attributes->where('name', 'socket')->first()->value;
        $cpuCoolerSocket = $cpuCooler->attributes->where('name', 'socket')->first()->value;
        //FIXME: сокеты, которые поддерживает кулер, может быть несколько
        if ($cpuSocket == $cpuCoolerSocket) {
            return ['compatible' => true, 'message' => ''];
        }
    }

    public static function checkCaseWithMotherboard(GetComponentDto $case, GetComponentDto $motherboard)
    {
        $caseFormFactor = $case->attributes->where('name', 'form_factor')->first()->value;
        $motherboardFormFactor = $motherboard->attributes->where('name', 'form_factor')->first()->value;

        if ($caseFormFactor === $motherboardFormFactor) {
            return ['compatible' => true, 'message' => ''];
        }

        return ['compatible' => false, 'message' => 'Мат. плата и корпус имеют разные форм-факторы'];
    }

    public static function checkCaseWithCPUCooler(GetComponentDto $case, GetComponentDto $cpuCooler)
    {
        $maxCPUCoolerHeight = $case->attributes->where('max_cpu_cooler_length')->first()->value;
        $cpuCoolerHeight = $cpuCooler->attributes->where('height')->first()->value;
        if ($cpuCoolerHeight <= $maxCPUCoolerHeight) {
            return ['compatible' => true, 'message' => ''];
        }
        return ['compatible' => false, 'message' => 'Неподходящие габариты процессорного кулера и корпуса'];
    }

    public static function checkPowerSupplyWithMotherboard(GetComponentDto $ps, GetComponentDto $motherboard)
    {
        if (!self::checkFormFactorBetweenMotherboardAndPowerSupply($ps, $motherboard)) {
            return ['compatible' => false, 'message' => 'Блок питания и мат. плата имеют несовместимые форм-факторы'];
        }

        $powerSupplyMainSocket = $ps->attributes->where('name', 'main_socket')->first()->value;
        $motherboardSocket = $motherboard->attributes->where('name', 'power_supply_main_socket')->first()->value;

        if (!$powerSupplyMainSocket == $motherboardSocket) {
            return ['compatible' => false, 'Не подходит основной кабель питания мат. платы'];
        }

        $powerSupplyCPUSocket = $ps->attributes->where('name', 'cpu_socket')->first()->value;
        $motherboardCPUPowerSocket = $motherboard->attributes->where('name', 'cpu_power_socket')->first()->value;

        if (!$powerSupplyCPUSocket == $motherboardCPUPowerSocket) {
            return ['compatible' => false, 'Не подходит  кабель питания процессора в  мат. плате'];
        }

        return ['compatible' => true, 'message' => ''];
    }

    private static function checkFormFactorBetweenMotherboardAndPowerSupply(
        GetComponentDto $ps,
        GetComponentDto $motherboard
    ): bool
    {
        $powerSupplyFormFactor = $ps->attributes->where('name', 'form_factor')->first()->value;
        $motherboardFormFactor = $motherboard->attributes->where('name', 'power_supply_form_factor')->first()->value;
        $powerSupplySizes = PowerSupplyFormFactor::getValue($powerSupplyFormFactor);
        $supportedPowerSupplySizes = PowerSupplyFormFactor::getValue($motherboardFormFactor);

        $isLengthFit = $supportedPowerSupplySizes['length'] >= $powerSupplySizes['height'];
        $isWidthFit = $supportedPowerSupplySizes['width'] >= $powerSupplySizes['width'];
        $isHeightFit = $supportedPowerSupplySizes['height'] >= $powerSupplySizes['height'];

        if ($isHeightFit && $isLengthFit && $isWidthFit) {
            return true;
        }

        return false;
    }
}
