import Components from '../pages/component/Components';
import React from 'react';
import Main from '../pages/Main';
import Login from '../pages/login/Login';
import CreateBuild from '../pages/build/CreateBuild';
import MyBuilds from '../pages/profile/MyBuilds';
import UsersBuilds from '../pages/build/UsersBuilds';
import NotFound from '../pages/NotFound';
import UserProfile from "../pages/profile/UserProfile";

export interface IRoute {
	uri: string;
	component: React.ComponentType;
}

export enum RouteNames {
	COMPONENTS = '/components',
	MAIN = '/',
	LOGIN = '/login',
	CREATEBUILD = '/create-build',
	PROFILE = '/profile',
	MYBUILDS = '/profile/my-builds',
	USERSBUILDS = '/users-builds',
	NOTFOUND = '/not-found'
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
		uri: RouteNames.COMPONENTS,
		component: Components,
	},
	{
		uri: RouteNames.USERSBUILDS,
		component: UsersBuilds,
	},
	{
		uri: RouteNames.NOTFOUND,
		component: NotFound,
	},
];

export const authUserRoutes: IRoute[] = [
	{
		uri: RouteNames.CREATEBUILD,
		component: CreateBuild,
	},
	{
		uri: RouteNames.MYBUILDS,
		component: MyBuilds,
	},
	{
		uri: RouteNames.PROFILE,
		component: UserProfile,
	},
];
