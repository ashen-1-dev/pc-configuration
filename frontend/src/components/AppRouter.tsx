import React, { ReactNode } from 'react';
import { Route, Routes } from 'react-router-dom';
import { routes } from '../router';

const AppRouter: React.FC = () => {
	return (
		<Routes>
			{routes.map(route => (
				<Route
					key={route.uri}
					path={route.uri}
					element={(<route.component />) as unknown as ReactNode}
				/>
			))}
		</Routes>
	);
};

export default AppRouter;
