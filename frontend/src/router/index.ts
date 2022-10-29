import Component from '../pages/component/Component';
import React from 'react';
import Main from '../pages/Main';
import Login from '../pages/login/Login';

export interface IRoute {
	uri: string;
	component: React.ComponentType;
}

export enum RouteNames {
	COMPONENTS = '/components',
	MAIN = '/',
	LOGIN = '/login',
}

export const routes: IRoute[] = [
	{
		uri: RouteNames.COMPONENTS,
		component: Component,
	},
	{
		uri: RouteNames.MAIN,
		component: Main,
	},
	{
		uri: RouteNames.LOGIN,
		component: Login,
	},
];
