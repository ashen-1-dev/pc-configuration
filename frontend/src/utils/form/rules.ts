export const rules = {
	required: (message: string = 'Это обязательное поле'): object => ({
		required: true,
		message,
	}),
};
