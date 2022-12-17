export const setAuthToken = (token: string): void => {
	localStorage.setItem('accessToken', token);
};

export const removeAuthToken = (): void => {
	localStorage.removeItem('accessToken');
};
