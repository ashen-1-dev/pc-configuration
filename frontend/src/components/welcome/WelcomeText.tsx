import React, { FC } from 'react';
import { Button, Row, Typography } from 'antd';
import './WelcomeText.css';
import { useNavigate } from 'react-router-dom';
import { RouteNames } from '../../router';

const WelcomeText: FC = () => {
	const navigate = useNavigate();
	const { Title } = Typography;
	return (
		<Row justify={'center'} align={'middle'} className={'h100'}>
			<div className={'welcome-block'}>
				<Title>Онлайн конфигуратор ПК</Title>
				<Title level={5} type={'secondary'}>
					Собери сборку своей мечты
				</Title>
				<Button
					size={'large'}
					type={'primary'}
					shape={'round'}
					onClick={() => navigate(RouteNames.CREATEBUILD)}
				>
					Создать свою сборку
				</Button>
			</div>
		</Row>
	);
};

export default WelcomeText;
