import axios from 'axios';

const accessToken = localStorage.getItem('accessToken');
const authHeader = accessToken != null ? 'Bearer ' + accessToken : null;

export const axiosInstance = axios.create({
	baseURL: process.env.REACT_APP_API_URL,
	headers: {
		common: {
			Accept: 'application/json',
			Authorization: authHeader,
		},
	},
});

export const setAxiosAuthToken = (token: string): void => {
	axiosInstance.defaults.headers.Authorization = 'Bearer ' + token;
};
