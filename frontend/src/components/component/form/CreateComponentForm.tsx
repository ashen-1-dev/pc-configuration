import {Button, Form, FormInstance, Input, Select, Space, Upload} from 'antd';
import React, {FC, useState} from 'react';
import {useMutation, useQuery, useQueryClient} from '@tanstack/react-query';
import {rules} from '../../../utils/form/rules';
import ComponentTypeService from '../../../services/type/component-type.service';
import {UploadOutlined} from '@ant-design/icons';
import ComponentService from '../../../services/component/ComponentService';
import {convertDataToCreateComponentDto} from '../../../pages/component/helper';
import {GetRequiredAttributesDto} from '../../../models/type/GetRequiredAttributes.dto';
import {dummyRequest} from "../../../utils/request";

interface CreateComponentFormProps {
	form?: FormInstance;
	onSuccess: () => void;
}

const CreateComponentForm: FC<CreateComponentFormProps> = ({
															   form,
															   onSuccess,
														   }) => {
	const [selectedType, setSelectedType] = useState<string | null>(null);
	const [requiredAttributes, setRequiredAttributes] = useState<GetRequiredAttributesDto[] | null>(null);
	// FIXME: refactor
	const client = useQueryClient();
	useQuery({
		queryKey: ['required-attributes', selectedType],
		enabled: !(selectedType == null),
		queryFn: async () =>
			await ComponentTypeService.getRequiredAttributes(
				selectedType as string,
			),
		onSuccess: data => setRequiredAttributes(data),
		refetchOnWindowFocus: false,
		refetchInterval: false,
	});
	const {data: componentTypes} = useQuery({
		queryKey: ['get component types'],
		queryFn: ComponentTypeService.getComponentTypes,
		refetchInterval: false,
	});
	const {mutate} = useMutation({
		mutationFn: ComponentService.createComponent,
		mutationKey: ['create component'],
		onSuccess: async () => {
			await client.invalidateQueries(['components']);
		},
	});

	const onTypeChange = async (type: string): Promise<void> => {
		setSelectedType(type);
	};

	const onFinish = (values: any): void => {
		const dto = convertDataToCreateComponentDto(values);
		mutate(dto);
		onSuccess();
	};

	return (
		<Form
			form={form}
			name="component"
			labelCol={{span: 8}}
			wrapperCol={{span: 16}}
			initialValues={{remember: true}}
			onFinish={onFinish}
			autoComplete="off"
		>
			<Form.Item
				name={'name'}
				rules={[rules.required()]}
				label={'Название'}
			>
				<Input/>
			</Form.Item>
			<Form.Item name={'description'} label={'Описание'}>
				<Input.TextArea size={'large'}/>
			</Form.Item>
			{requiredAttributes?.map((ra, i) => (
				// FIXME
				<Space align="baseline" key={ra.name}>
					<Form.Item
						initialValue={ra.name}
						name={['attributes', i, 'name']}
						required
					>
						<Input
							defaultValue={ra.name}
							size={'large'}
							style={{color: 'rgba(0,0,0,.85)'}}
							disabled
						/>
					</Form.Item>
					<Form.Item
						rules={[rules.required()]}
						name={['attributes', i, 'value']}
					>
						{ra.list != null ? (
							<Select
								size={'large'}
								placeholder={'Выберите'}
								style={{minWidth: '136px'}}
								options={ra.list.map(i => ({
									label: i,
									value: i,
								}))}
							/>
						) : (
							<Input size={'large'}/>
						)}
					</Form.Item>
				</Space>
			))}
			<Form.List name="attributesOptional">
				{(fields, {add, remove}) => (
					<>
						{fields.map(({key, name, ...restFields}) => (
							<Space
								key={key}
								style={{
									display: 'flex',
									marginBottom: 8,
								}}
								align="baseline"
							>
								<Form.Item {...restFields} name={[name, 'name']}>
									<Input
										size={'large'}
										style={{color: 'rgba(0,0,0,.85)'}}
									/>
								</Form.Item>
								<Form.Item
									{...restFields}
									name={[name, 'value']}
								>
									<Input size={'large'}/>
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
				getValueFromEvent={({file}) => file.originFileObj}
			>
				<Upload
					maxCount={1}
					accept={'image/*'}
					listType="picture" // @ts-expect-error
					customRequest={dummyRequest}
				>
					<Button icon={<UploadOutlined/>}>Загрузить</Button>
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
