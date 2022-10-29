import React, { FC } from 'react';
import MainLayout from '../../layouts/MainLayout';
import LoginForm from '../../components/form/LoginForm';
import { Col, Divider, Row, Typography } from 'antd';
import AuthForm from '../../components/form/AuthForm';
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
					<AuthForm />
				</Col>
			</Row>
		</MainLayout>
	);
};

export default Login;
