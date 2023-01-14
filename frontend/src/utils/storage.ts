export const setAuthToken = (token: string): void => {
	localStorage.setItem('accessToken', token);
};

export const removeAuthToken = (): void => {
	localStorage.removeItem('accessToken');
};

export const getAuthToken = (): string | null => {
	return localStorage.getItem('accessToken');
};
