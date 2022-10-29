import React, { FC } from 'react';
import MainLayout from '../layouts/MainLayout';
import WelcomeText from '../components/welcome/WelcomeText';

const Main: FC = () => {
	return (
		<MainLayout>
			<WelcomeText />
		</MainLayout>
	);
};

export default Main;
