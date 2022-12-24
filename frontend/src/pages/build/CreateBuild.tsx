import React, { FC } from 'react';
import MainLayout from '../../layouts/MainLayout';
import CreateBuildForm from '../../components/build/CreateBuildForm';
import { useLocation } from 'react-router-dom';

const CreateBuild: FC = () => {
	const { state: build } = useLocation();
	return (
		<MainLayout>
			<CreateBuildForm build={build} />
		</MainLayout>
	);
};

export default CreateBuild;
