import React from 'react';
import { Route, Routes } from 'react-router-dom';
import { authUserRoutes, publicRoutes, RouteNames } from '../router';
import NotFound from '../pages/NotFound';
import PrivateRoute from './PrivateRoute';

const AppRouter: React.FC = () => {
	return (
		<Routes>
			{publicRoutes.map(route => (
				<Route
					key={route.uri}
					path={route.uri}
					element={<route.component />}
				/>
			))}
			{authUserRoutes.map(route => (
				<Route
					key={route.uri}
					path={route.uri}
					element={<PrivateRoute children={<route.component />} />}
				/>
			))}
			<Route
				key={RouteNames.NOTFOUND}
				path={'*'}
				element={<NotFound />}
			/>
		</Routes>
	);
};

export default AppRouter;
