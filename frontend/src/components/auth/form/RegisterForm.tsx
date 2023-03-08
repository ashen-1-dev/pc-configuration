import React, {FC, useState} from 'react';
import {Button, Form, Input, Upload} from 'antd';
import {rules} from '../../../utils/form/rules';
import {useMutation} from '@tanstack/react-query';
import AuthServce from '../../../services/auth/AuthServce';
import {RouteNames} from '../../../router';
import {useNavigate} from 'react-router-dom';
import {UploadOutlined} from "@ant-design/icons";
import {dummyRequest} from '../../../utils/request';


const RegisterForm: FC = () => {
	const navigate = useNavigate();
	const [error, setError] = useState<any>({});
	const {mutate} = useMutation({
		mutationKey: ['register user'],
		mutationFn: AuthServce.register,
		onSuccess: data => {
			localStorage.setItem('accessToken', data.accessToken);
			navigate(RouteNames.MAIN);
			window.location.reload();
		},
		onError: () => setError('Ошибка')
	});

	const onFinish = (values: any): void => {
		mutate(values);
	};

	// @ts-ignore
	return (
		<Form name="register" onFinish={onFinish}>
			<div style={{color: '#ff4d4f'}}>
				{error?.response?.data?.message}
			</div>
			<Form.Item label={'Почта'} name="email" rules={[rules.required()]}>
				<Input type={'email'}/>
			</Form.Item>

			<Form.Item
				label={'Имя'}
				name="firstName"
				rules={[rules.required()]}
			>
				<Input/>
			</Form.Item>

			<Form.Item
				label={'Фамилия'}
				name="lastName"
				rules={[rules.required()]}
			>
				<Input/>
			</Form.Item>

			<Form.Item
				label="Пароль"
				name="password"
				rules={[rules.required(), rules.min(4)]}
			>
				<Input.Password/>
			</Form.Item>
			<Form.Item
				label={'Фотография'}
				name={'photo'}
				getValueFromEvent={({file}) => file.originFileObj}
			>
				<Upload
					maxCount={1}
					accept={'image/*'}
					listType="picture"
					//@ts-ignore
					customRequest={dummyRequest}
				>
					<Button icon={<UploadOutlined/>}>Загрузить</Button>
				</Upload>
			</Form.Item>
			<Form.Item wrapperCol={{offset: 8, span: 16}}>
				<Button
					shape={'round'}
					size={'large'}
					type="primary"
					htmlType="submit"
				>
					Зарегистрироваться
				</Button>
			</Form.Item>
		</Form>
	);
};

export default RegisterForm;
