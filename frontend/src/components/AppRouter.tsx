import React from 'react';
import { Route, Routes } from 'react-router-dom';
import { authUserRoutes, publicRoutes } from '../router';

const AppRouter: React.FC = () => {
	const userIsAuth = !!localStorage.getItem('accessToken');

	return (
		<Routes>
			{publicRoutes.map(route => (
				<Route
					key={route.uri}
					path={route.uri}
					element={<route.component />}
				/>
			))}
			{userIsAuth &&
				authUserRoutes.map(route => (
					<Route
						key={route.uri}
						path={route.uri}
						element={<route.component />}
					/>
				))}
		</Routes>
	);
};

export default AppRouter;
