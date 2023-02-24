import React, {useState} from 'react';
import MainLayout from '../../layouts/MainLayout';
import {Button, Row, Typography} from 'antd';
import {useMutation, useQuery, useQueryClient} from '@tanstack/react-query';
import BuildService from '../../services/build/BuildService';
import {GetBuildDto} from '../../models/build/get-build.dto';
import BuildList from '../../components/build/BuildList';
import {useNavigate} from 'react-router-dom';
import {RouteNames} from '../../router';

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
	const {mutate: deleteBuild} = useMutation({
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
		navigate(RouteNames.CREATEBUILD, {replace: true, state: build});
	};

	const [builds, setBuilds] = useState<GetBuildDto[]>();

	return (
		<MainLayout>
			<Row style={{paddingTop: '20px'}} justify={'center'}>
				<Typography.Title>Мои сборки</Typography.Title>
			</Row>
			{
				builds?.length
					?
					<Row style={{paddingTop: '20px'}}>
						<BuildList
							onBuildUpdate={onBuildUpdate}
							onBuildDelete={onBuildDelete}
							builds={builds}
						/>
					</Row>
					:
					<Row justify={'center'}>
						<div style={{display: 'flex', flexDirection: 'column'}}>

							<Typography.Title level={4}>Похоже у вас еще нет сборок</Typography.Title>
						</div>
					</Row>
			}
			<Row justify={'center'}>

				<Button onClick={() => navigate(RouteNames.CREATEBUILD)}
						type={'primary'} shape={'round'}
						size={'large'}>
					<Typography.Title level={5}>Создать
						сборку</Typography.Title>
				</Button>
			</Row>

		</MainLayout>
	);
};

export default MyBuilds;
