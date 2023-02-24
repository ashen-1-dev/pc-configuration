import React, {useContext, useEffect, useState} from 'react';
import {useQuery} from '@tanstack/react-query';
import BuildService from '../../services/build/BuildService';
import {GetBuildDto} from '../../models/build/get-build.dto';
import MainLayout from '../../layouts/MainLayout';
import {Form, Input, Row, Switch, Typography} from 'antd';
import BuildList from '../../components/build/BuildList';
import {UserContext} from '../../App';
import useDebounce from "../../hooks/useDebounce";
import {BuildQuery} from "../../models/build/build.query";

const UsersBuilds = () => {
	const user = useContext(UserContext);
	const [form] = Form.useForm();
	const [query, setQuery] = useState<BuildQuery>({q: '', ready: 1});
	const debouncedQuery = useDebounce(query, 1);

	useEffect(() => {
		refetchBuilds();
	}, [debouncedQuery]);

	const {data, refetch: refetchBuilds} = useQuery({
		queryKey: ['get users builds'],
		queryFn: async () => await BuildService.getBuilds(query),
		onSuccess: data => {
			setBuilds(data);
		},
	});

	const onFiltersChange = () => {
		form.submit();
	}

	const onFilterSubmit = (data: BuildQuery) => {
		if (data.ready != null) {
			data.ready = +data.ready
		}
		setQuery(data)
	}

	const {refetch: refetchAddUsersBuild, isSuccess, isError} = useQuery({
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
		refetchAddUsersBuild();
	}, [addBuildId]);

	const [builds, setBuilds] = useState<GetBuildDto[]>();

	return (
		<MainLayout>
			<div style={{padding: '3% 20%'}}>
				<Row justify={'center'}>
					<Form
						onFinish={onFilterSubmit}
						form={form}
						onValuesChange={onFiltersChange}
					>
						<Typography.Title level={4}>Фильтры</Typography.Title>
						<Form.Item
							label={'По названию'}
							name={'q'}
						>
							<Input placeholder={'Введите название...'}/>
						</Form.Item>
						<Form.Item
							label={'Готовая сборка: '}
							name={'ready'}
						>
							<Switch defaultChecked/>
						</Form.Item>
					</Form>
				</Row>
				<Row style={{paddingTop: '20px'}} justify={'center'}>
					{
						builds && builds.length
							?
							<>
								<Typography.Title>Пользовательские сборки</Typography.Title>
								<BuildList
									onBuildAdd={onBuildAdd}
									builds={builds.filter(x => x.user.id !== user?.id)}
								/>
							</>
							:
							<Typography.Title level={4}>Извините, сборки не найдены</Typography.Title>
					}
				</Row>
			</div>
		</MainLayout>
	);
};

export default UsersBuilds;
