import React, { FC } from 'react';
import './App.css';
import AppRouter from './components/AppRouter';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

const queryClient = new QueryClient();

const App: FC = () => {
	return (
		<div>
			<QueryClientProvider client={queryClient}>
				<AppRouter />
			</QueryClientProvider>
		</div>
	);
};

export default App;
