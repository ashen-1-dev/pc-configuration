import React, { FC } from 'react';
import { Button, Form, Input } from 'antd';
import { rules } from '../../../utils/form/rules';
import { useMutation } from '@tanstack/react-query';
import AuthServce from '../../../services/auth/AuthServce';
import { RouteNames } from '../../../router';
import { useNavigate } from 'react-router-dom';

const RegisterForm: FC = () => {
	const navigate = useNavigate();
	const { mutate } = useMutation({
		mutationKey: ['register user'],
		mutationFn: AuthServce.register,
		onSuccess: data => {
			localStorage.setItem('accessToken', data.accessToken);
			navigate(RouteNames.MAIN);
		},
	});

	const onFinish = (values: any): void => {
		mutate(values);
	};

	return (
		<Form name="register" onFinish={onFinish}>
			<Form.Item label={'Почта'} name="email" rules={[rules.required()]}>
				<Input type={'email'} />
			</Form.Item>

			<Form.Item
				label={'Имя'}
				name="firstName"
				rules={[rules.required()]}
			>
				<Input />
			</Form.Item>

			<Form.Item
				label={'Фамилия'}
				name="lastName"
				rules={[rules.required()]}
			>
				<Input />
			</Form.Item>

			<Form.Item
				label="Пароль"
				name="password"
				rules={[rules.required(), rules.min(4)]}
			>
				<Input.Password />
			</Form.Item>
			<Form.Item wrapperCol={{ offset: 8, span: 16 }}>
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
