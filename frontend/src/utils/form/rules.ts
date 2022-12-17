export const rules = {
	required: (message: string = 'Это обязательное поле'): object => ({
		required: true,
		message,
	}),
	min: (
		number: number,
		message: string = 'Минимальная длина поля ' + number,
	): object => ({
		min: number,
		message,
	}),
};
