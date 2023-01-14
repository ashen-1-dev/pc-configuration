import React from 'react';
import { Navigate } from 'react-router-dom';
import { RouteNames } from '../router';
import { getAuthToken } from '../utils/storage';

interface PrivateRouteProps {
	redirectPath?: string;
	children: any;
}

const PrivateRoute = ({
	redirectPath = RouteNames.LOGIN,
	children,
}: PrivateRouteProps) => {
	const authToken = getAuthToken();

	if (authToken == null) {
		return <Navigate to={redirectPath} />;
	}
	return children;
};

export default PrivateRoute;
