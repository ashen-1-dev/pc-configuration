import React, {createContext, FC, useEffect, useState} from 'react';
import './App.css';
import AppRouter from './components/AppRouter';
import {QueryClient, QueryClientProvider} from '@tanstack/react-query';
import {GetUserDto} from './models/user/get-user.dto';
import AuthServce from './services/auth/AuthServce';
import {getAuthToken, removeAuthToken} from "./utils/storage";

const queryClient = new QueryClient();

export const UserContext = createContext<GetUserDto | undefined>(undefined);

const App: FC = () => {
	const [user, setUser] = useState<GetUserDto | undefined>();
	const fetchUser = async () => {
		return await AuthServce.authUser();
	};
	
	useEffect(() => {
		if (user != null) return;

		getAuthToken() && fetchUser().then(response => setUser(response));
		if (!user) {
			removeAuthToken();
		}
	}, []);

	return (
		<div>
			<UserContext.Provider value={user}>
				<QueryClientProvider client={queryClient}>
					<AppRouter/>
				</QueryClientProvider>
			</UserContext.Provider>
		</div>
	);
};

export default App;
