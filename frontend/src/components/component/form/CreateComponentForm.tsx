import { Button, Form, FormInstance, Input, Select, Space, Upload } from 'antd';
import React, { FC, useState } from 'react';
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query';
import { rules } from '../../../utils/form/rules';
import ComponentTypeService from '../../../services/type/component-type.service';
import { UploadOutlined } from '@ant-design/icons';
import ComponentService from '../../../services/component/ComponentService';
import { convertDataToCreateComponentDto } from '../../../pages/component/helper';

interface CreateComponentFormProps {
	form?: FormInstance;
	onSuccess: () => void;
}

// @ts-expect-error
const dummyRequest = ({ onSuccess }): void => {
	setTimeout(() => {
		onSuccess('ok');
	}, 0);
};

const CreateComponentForm: FC<CreateComponentFormProps> = ({
	form,
	onSuccess,
}) => {
	const [selectedType, setSelectedType] = useState<string | null>(null);
	// FIXME: refactor
	const client = useQueryClient();
	const { data: requiredAttributes, refetch } = useQuery({
		queryKey: ['required-attributes', selectedType],
		queryFn: async () =>
			await ComponentTypeService.getRequiredAttributes(
				selectedType as string,
			),
		enabled: !!selectedType,
	});
	const { data: componentTypes } = useQuery({
		queryKey: ['get component types'],
		queryFn: ComponentTypeService.getComponentTypes,
		refetchInterval: false,
	});
	const { mutate } = useMutation({
		mutationFn: ComponentService.createComponent,
		mutationKey: ['create component'],
		onSuccess: async () => {
			await client.invalidateQueries(['components']);
			form?.resetFields();
		},
	});

	const onTypeChange = async (type: string): Promise<void> => {
		setSelectedType(type);
		await refetch();
	};

	const onFinish = (values: any): void => {
		console.log('values: ', values);
		const dto = convertDataToCreateComponentDto(values);
		mutate(dto);
		onSuccess();
	};
	return (
		<Form
			form={form}
			name="component"
			labelCol={{ span: 8 }}
			wrapperCol={{ span: 16 }}
			initialValues={{ remember: true }}
			onFinish={onFinish}
			autoComplete="off"
		>
			<Form.Item
				name={'name'}
				rules={[rules.required()]}
				label={'Название'}
			>
				<Input />
			</Form.Item>
			<Form.Item name={'description'} label={'Описание'}>
				<Input.TextArea size={'large'} />
			</Form.Item>
			{selectedType &&
				requiredAttributes?.map((x, i) => (
					<Space
						style={{
							display: 'flex',
							justifyContent: 'center',
						}}
						align="baseline"
						key={x.name}
					>
						<Form.Item
							initialValue={x.name}
							name={['attributes', i, 'name']}
						>
							<Input
								style={{ color: 'rgba(0,0,0,.85)' }}
								disabled
							/>
						</Form.Item>
						<Form.Item
							rules={[rules.required()]}
							name={['attributes', i, 'value']}
						>
							<Input />
						</Form.Item>
					</Space>
				))}
			<Form.List name="attributesOptional">
				{(fields, { add, remove }) => (
					<>
						{fields.map(({ key, name, ...restField }) => (
							<Space
								key={key}
								style={{
									display: 'flex',
									marginBottom: 8,
									justifyContent: 'center',
								}}
								align="baseline"
							>
								<Form.Item {...restField} name={[name, 'name']}>
									<Input />
								</Form.Item>
								<Form.Item
									{...restField}
									name={[name, 'value']}
								>
									<Input />
								</Form.Item>
							</Space>
						))}
						<Form.Item>
							<Button onClick={() => add()} block>
								Добавить атрибут
							</Button>
						</Form.Item>
					</>
				)}
			</Form.List>
			<Form.Item
				name={'photo'}
				label={'Фото'}
				getValueFromEvent={({ file }) => file.originFileObj}
			>
				<Upload
					maxCount={1}
					accept={'image/*'}
					listType="picture" // @ts-expect-error
					customRequest={dummyRequest}
				>
					<Button icon={<UploadOutlined />}>Загрузить</Button>
				</Upload>
			</Form.Item>
			<Form.Item
				label="Тип комплектующего"
				name="type"
				rules={[rules.required()]}
			>
				<Select onChange={onTypeChange}>
					{componentTypes?.map(x => (
						<Select.Option key={x.name} value={x.name}>
							{x.name}
						</Select.Option>
					))}
				</Select>
			</Form.Item>
		</Form>
	);
};

export default CreateComponentForm;
