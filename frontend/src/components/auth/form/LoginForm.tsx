import { Alert, Button, Form, Input, Space } from 'antd';
import React, { useState } from 'react';
import { rules } from '../../../utils/form/rules';
import { useMutation } from '@tanstack/react-query';
import AuthServce from '../../../services/auth/AuthServce';
import { useNavigate } from 'react-router-dom';
import { RouteNames } from '../../../router';
import { setAuthToken } from '../../../utils/storage';
import { setAxiosAuthToken } from '../../../config/axios';

const LoginForm: React.FC = () => {
	const { mutate } = useMutation({
		mutationKey: ['login'],
		mutationFn: AuthServce.login,
		onSuccess: data => {
			setAuthToken(data.accessToken);
			setAxiosAuthToken(data.accessToken);
			navigate(RouteNames.MAIN);
			window.location.reload();
		},
		onError: error => {
			setError('Неправильный логин или пароль');
		},
	});

	const navigate = useNavigate();
	const [error, setError] = useState<string | null>(null);

	const onFinish = (values: any) => {
		mutate(values);
	};

	return (
		<Form
			name="login"
			initialValues={{ remember: true }}
			onFinish={onFinish}
		>
			<Space direction={'vertical'}>
				{error && <Alert type={'error'} message={error} />}
				<Form.Item
					label="Почта"
					name="email"
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
						Войти
					</Button>
				</Form.Item>
			</Space>
		</Form>
	);
};

export default LoginForm;
