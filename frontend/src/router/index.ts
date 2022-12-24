import Component from '../pages/component/Component';
import React from 'react';
import Main from '../pages/Main';
import Login from '../pages/login/Login';
import CreateBuild from '../pages/build/CreateBuild';
import MyBuilds from '../pages/profile/MyBuilds';
import UsersBuilds from '../pages/build/UsersBuilds';
import NotFound from '../pages/NotFound';

export interface IRoute {
	uri: string;
	component: React.ComponentType;
}

export enum RouteNames {
	COMPONENTS = '/components',
	MAIN = '/',
	LOGIN = '/login',
	CREATEBUILD = '/create-build',
	MYBUILDS = '/profile/my-builds',
	USERSBUILDS = '/users-builds',
	NOTFOUND = '/not-found',
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
	{
		uri: RouteNames.NOTFOUND,
		component: NotFound,
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
	{
		uri: RouteNames.MYBUILDS,
		component: MyBuilds,
	},
	{
		uri: RouteNames.USERSBUILDS,
		component: UsersBuilds,
	},
];
