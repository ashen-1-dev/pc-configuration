import React, { FC, useCallback, useEffect, useState } from 'react';
import ComponentTypeService from '../../services/type/component-type.service';
import { useMutation, useQuery } from '@tanstack/react-query';
import { Button, Col, Form, Input, Row } from 'antd';
import ComponentTypesList from '../component/component-type-list/ComponentTypesList';
import { GetComponentDto } from '../../models/component/get-component.dto';
import { rules } from '../../utils/form/rules';
import BuildService from '../../services/build/BuildService';
import CheckStatus from './CheckStatus';

const CreateBuildForm: FC = () => {
	const { data, isSuccess } = useQuery({
		queryKey: ['get component types'],
		queryFn: ComponentTypeService.getComponentTypes,
	});
	const {
		mutate: checkBuild,
		data: checkStatus,
		isSuccess: isCheckStatusSuccess,
	} = useMutation({
		mutationFn: BuildService.checkBuildIsReady,
		mutationKey: ['check build is ready'],
		onSuccess: data => console.log(data),
	});
	const { mutate: createBuild } = useMutation({
		mutationKey: ['create build'],
		mutationFn: BuildService.createBuild,
	});

	const [components, setComponents] = useState<GetComponentDto[]>([]);

	useEffect(() => {
		if (components.length > 0) {
			const componentsIds = components.map(x => x.id);
			checkBuild({ componentsIds });
		}
	}, [components]);

	const onComponentAdd = useCallback((component: GetComponentDto) => {
		setComponents(prevState => {
			const componentIndexToReplace = prevState.findIndex(
				x => x.type === component.type,
			);

			delete prevState[componentIndexToReplace];

			return [...prevState, component].filter(Boolean);
		});
	}, []);

	const onComponentDelete = useCallback(
		(componentToRemove: GetComponentDto) => {
			setComponents(prevState => {
				return prevState.filter(
					component => component.id !== componentToRemove.id,
				);
			});
		},
		[],
	);

	const onFinish = (values: any): void => {
		const dto = { ...values, componentsIds: components.map(x => x.id) };
		createBuild(dto);
	};

	return (
		<Form onFinish={onFinish}>
			<Row justify={'center'} style={{ padding: '30px 0' }}>
				{isCheckStatusSuccess && (
					<CheckStatus checkStatus={checkStatus} />
				)}
			</Row>
			<Row justify={'space-evenly'} style={{ paddingTop: '4em' }}>
				{isSuccess && (
					<>
						<Col>
							<ComponentTypesList
								label={'Обязательные компоненты'}
								onComponentAdd={onComponentAdd}
								onComponentDelete={onComponentDelete}
								items={data?.filter(x => x.required)}
							/>
						</Col>
						<Col>
							<ComponentTypesList
								label={'Дополнительные компоненты'}
								onComponentAdd={onComponentAdd}
								onComponentDelete={onComponentDelete}
								items={data?.filter(x => !x.required)}
							/>
						</Col>
					</>
				)}
			</Row>
			<Row justify={'center'} gutter={50} style={{ paddingTop: '4em' }}>
				<Form.Item
					style={{ minWidth: '50%' }}
					rules={[rules.required()]}
					label={'Название сборки'}
					name={'name'}
				>
					<Input size={'large'} />
				</Form.Item>
			</Row>
			<Row justify={'center'} gutter={50} style={{ paddingTop: '4em' }}>
				<Form.Item
					style={{ minWidth: '50%' }}
					label={'Описание'}
					name={'description'}
				>
					<Input.TextArea rows={4} size={'large'} />
				</Form.Item>
			</Row>
			<Row justify={'center'} gutter={50} style={{ paddingTop: '4em' }}>
				<Form.Item>
					<Button type="primary" htmlType="submit">
						Создать
					</Button>
				</Form.Item>
			</Row>
			)
		</Form>
	);
};

export default CreateBuildForm;
