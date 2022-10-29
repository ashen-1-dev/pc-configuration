import React, { FC, ReactNode } from 'react';
import { Layout } from 'antd';
import Navbar from '../components/navbar/Navbar';

const MainLayout: FC<{ children: ReactNode }> = ({ children }) => {
	return (
		<Layout>
			<Navbar />
			<Layout.Content>{children}</Layout.Content>
		</Layout>
	);
};

export default MainLayout;
