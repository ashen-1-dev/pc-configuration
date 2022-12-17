export const enum ComponentType {
	GPU = 'gpu',
	CPU = 'cpu',
	Storage = 'diskdrive',
	RAM = 'ram',
	Motherboard = 'motherboard',
	PowerSupply = 'powersupply',
	CPUCooler = 'cpucooler',
	CASE = 'case',
}

export const TypeName = {
	[ComponentType.CPU]: 'Процессор',
	[ComponentType.GPU]: 'Видеокарта',
	[ComponentType.RAM]: 'Оперативная память',
	[ComponentType.Storage]: 'Хранение данных',
	[ComponentType.PowerSupply]: 'Блок питания',
	[ComponentType.Motherboard]: 'Материнская плата',
	[ComponentType.CPUCooler]: 'Охлаждение процессора',
	[ComponentType.CASE]: 'Корпус',
};
