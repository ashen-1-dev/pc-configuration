import React from 'react';
import { Route, Routes } from 'react-router-dom';
import { authUserRoutes, publicRoutes, RouteNames } from '../router';
import NotFound from '../pages/NotFound';

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
			<Route
				key={RouteNames.NOTFOUND}
				path={'*'}
				element={<NotFound />}
			/>
		</Routes>
	);
};

export default AppRouter;
