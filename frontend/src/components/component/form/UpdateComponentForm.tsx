import React, {FC, useEffect, useState} from 'react';
import {GetComponentDto} from "../../../models/component/get-component.dto";
import {Button, Form, FormInstance, Input, Select, Upload} from "antd";
import {convertDataToUpdateComponentDto} from "../../../pages/component/helper";
import {useMutation, useQuery, useQueryClient} from "@tanstack/react-query";
import ComponentService from "../../../services/component/ComponentService";
import {CreateComponentDto} from "../../../models/component/create-component.dto";
import {rules} from "../../../utils/form/rules";
import ComponentTypeService from "../../../services/type/component-type.service";
import {UploadOutlined} from "@ant-design/icons";

interface UpdateComponentFormProps {
	component: GetComponentDto;
	form?: FormInstance;
	onSuccess: () => void;
}

// @ts-expect-error
const dummyRequest = ({onSuccess}): void => {
	setTimeout(() => {
		onSuccess('ok');
	}, 0);
};

const UpdateComponentForm: FC<UpdateComponentFormProps> = ({component, form, onSuccess}) => {
	console.log(component)
	const {id, name, photoUrl, description, attributes, type} = component;
	const client = useQueryClient();
	const [selectedType, setSelectedType] = useState<string | null>(null);
	const {data: componentTypes} = useQuery({
		queryKey: ['get component types'],
		queryFn: ComponentTypeService.getComponentTypes,
		refetchInterval: false,
	});

	useEffect(() => {
		form?.resetFields();
		form?.setFieldsValue(component)
	}, [component, form])
	const {mutate: updateComponent} = useMutation<GetComponentDto,
		any,
		[componentId: number, updateComponentDto: Partial<CreateComponentDto>]>({
		mutationFn: async ([componentId, updateBuildDto]) =>
			await ComponentService.updateComponent(componentId, updateBuildDto),
		onSuccess: async () => {
			await client.invalidateQueries(['components']);
		},
	});
	const onTypeChange = async (type: string): Promise<void> => {
		setSelectedType(type);
	};
	useEffect(() => {
		setSelectedType(type)
	}, [])
	const onFinish = (values: any): void => {
		console.log('values', values);
		const dto = convertDataToUpdateComponentDto(values);
		updateComponent([id, dto]);
		onSuccess();
	};
	return (
		<Form
			name="component"
			form={form}
			labelCol={{span: 8}}
			wrapperCol={{span: 16}}
			initialValues={component}
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

export default UpdateComponentForm;