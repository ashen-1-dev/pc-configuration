import { Button, Checkbox, Form, Input } from 'antd';
import React from 'react';
import { rules } from '../../utils/form/rules';

const LoginForm: React.FC = () => {
	const onFinish = (values: any) => {
		console.log('Success:', values);
	};

	return (
		<Form
			name="login"
			initialValues={{ remember: true }}
			onFinish={onFinish}
		>
			<Form.Item label="Логин" name="login" rules={[rules.required()]}>
				<Input />
			</Form.Item>

			<Form.Item
				label="Пароль"
				name="password"
				rules={[rules.required()]}
			>
				<Input.Password />
			</Form.Item>

			<Form.Item name="remember" valuePropName="checked">
				<Checkbox>Запомнить</Checkbox>
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
		</Form>
	);
};

export default LoginForm;
