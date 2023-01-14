import React, { useState } from 'react';
import MainLayout from '../../layouts/MainLayout';
import { Row, Typography } from 'antd';
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query';
import BuildService from '../../services/build/BuildService';
import { GetBuildDto } from '../../models/build/get-build.dto';
import BuildList from '../../components/build/BuildList';
import { useNavigate } from 'react-router-dom';
import { RouteNames } from '../../router';

const MyBuilds = () => {
	const queryClient = useQueryClient();
	const navigate = useNavigate();
	const query = useQuery({
		queryKey: ['get auth user builds'],
		queryFn: async () => await BuildService.getAuthUserBuilds(),
		onSuccess: data => {
			setBuilds(data);
		},
	});
	const { mutate: deleteBuild } = useMutation({
		mutationKey: ['delete users build'],
		mutationFn: BuildService.removeBuild,
		onSuccess: () => {
			queryClient.invalidateQueries(['get auth user builds']);
		},
	});

	const onBuildDelete = (build: GetBuildDto) => {
		deleteBuild(build.id);
	};

	const onBuildUpdate = (build: GetBuildDto) => {
		navigate(RouteNames.CREATEBUILD, { replace: true, state: build });
	};

	const [builds, setBuilds] = useState<GetBuildDto[]>();

	return (
		<MainLayout>
			<Row style={{ paddingTop: '20px' }} justify={'center'}>
				<Typography.Title>Мои сборки</Typography.Title>
			</Row>
			<Row style={{ paddingTop: '20px' }}>
				{builds != null && (
					<BuildList
						onBuildUpdate={onBuildUpdate}
						onBuildDelete={onBuildDelete}
						builds={builds}
					/>
				)}
			</Row>
		</MainLayout>
	);
};

export default MyBuilds;
