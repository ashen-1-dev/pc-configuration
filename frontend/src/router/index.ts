import Component from '../pages/component/Component';
import React from 'react';
import Main from '../pages/Main';
import Login from '../pages/login/Login';
import CreateBuild from '../pages/build/CreateBuild';

export interface IRoute {
	uri: string;
	component: React.ComponentType;
}

export enum RouteNames {
	COMPONENTS = '/components',
	MAIN = '/',
	LOGIN = '/login',
	CREATEBUILD = '/create-build',
}

export const publicRoutes: IRoute[] = [
	{
		uri: RouteNames.MAIN,
		component: Main,
	},
	{
		uri: RouteNames.LOGIN,
		component: Login,
	},
];

export const authUserRoutes: IRoute[] = [
	{
		uri: RouteNames.COMPONENTS,
		component: Component,
	},
	{
		uri: RouteNames.CREATEBUILD,
		component: CreateBuild,
	},
];
