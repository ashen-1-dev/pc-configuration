import React, { createContext, FC, useEffect, useState } from 'react';
import './App.css';
import AppRouter from './components/AppRouter';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { GetUserDto } from './models/user/get-user.dto';
import AuthServce from './services/auth/AuthServce';

const queryClient = new QueryClient();

export const UserContext = createContext<GetUserDto | undefined>(undefined);

const App: FC = () => {
	const [user, setUser] = useState<GetUserDto | undefined>();
	useEffect(() => {
		const fetchUser = async () => {
			setUser(await AuthServce.authUser());
		};
		fetchUser();
	}, []);

	return (
		<div>
			<UserContext.Provider value={user}>
				<QueryClientProvider client={queryClient}>
					<AppRouter />
				</QueryClientProvider>
			</UserContext.Provider>
		</div>
	);
};

export default App;
