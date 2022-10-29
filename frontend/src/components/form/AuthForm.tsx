import React, { FC } from 'react';
import { Button, Form, Input } from 'antd';
import { rules } from '../../utils/form/rules';

const AuthForm: FC = () => {
	const onFinish = (values: any) => {
		console.log('Success:', values);
	};
	return (
		<Form name="register" onFinish={onFinish}>
			<Form.Item label="Логин" name="login" rules={[rules.required()]}>
				<Input />
			</Form.Item>

			<Form.Item label={'Почта'} name="email" rules={[rules.required()]}>
				<Input type={'email'} />
			</Form.Item>

			<Form.Item
				label="Пароль"
				name="password"
				rules={[rules.required()]}
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

export default AuthForm;
