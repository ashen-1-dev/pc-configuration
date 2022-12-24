import React, { useContext, useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import BuildService from '../../services/build/BuildService';
import { GetBuildDto } from '../../models/build/get-build.dto';
import MainLayout from '../../layouts/MainLayout';
import { Row, Typography } from 'antd';
import BuildList from '../../components/build/BuildList';
import { UserContext } from '../../App';

const UsersBuilds = () => {
	const user = useContext(UserContext);
	const { data } = useQuery({
		queryKey: ['get users builds'],
		queryFn: async () => await BuildService.getBuilds(),
		onSuccess: data => {
			setBuilds(data);
		},
	});

	const { refetch, isSuccess, isError } = useQuery({
		queryKey: ['add users build'],
		queryFn: async () => await BuildService.addUsersBuild(addBuildId),
		enabled: false,
		retry: false,
	});

	const [addBuildId, setAddBuildId] = useState(0);

	const onBuildAdd = (build: GetBuildDto) => {
		setAddBuildId(build.id);
	};

	useEffect(() => {
		if (addBuildId === 0) {
			return;
		}
		refetch();
	}, [addBuildId]);

	const [builds, setBuilds] = useState<GetBuildDto[]>();

	return (
		<MainLayout>
			<Row style={{ paddingTop: '20px' }} justify={'center'}>
				<Typography.Title>Пользовательские сборки</Typography.Title>
				{builds != null && (
					<BuildList
						onBuildAdd={onBuildAdd}
						builds={builds.filter(x => x.user.id !== user?.id)}
					/>
				)}
			</Row>
		</MainLayout>
	);
};

export default UsersBuilds;
