import React, { FC } from 'react';
import MainLayout from '../../layouts/MainLayout';
import LoginForm from '../../components/auth/form/LoginForm';
import { Col, Divider, Row, Typography } from 'antd';
import RegisterForm from '../../components/auth/form/RegisterForm';
import './Login.css';

const { Title } = Typography;

const Login: FC = () => {
	return (
		<MainLayout>
			<Row justify={'space-evenly'} align={'middle'} className={'h100'}>
				<Col span={5}>
					<Title className={'center-text'}>Авторизация</Title>
					<LoginForm />
				</Col>
				<Col className={'login-divider'}>
					<Divider type={'vertical'} />
				</Col>
				<Col span={5}>
					<Title className={'center-text'}>Впервые на сайте?</Title>
					<Title level={4} className={'center-text'}>
						Пройдите регистрацию
					</Title>
					<RegisterForm />
				</Col>
			</Row>
		</MainLayout>
	);
};

export default Login;
