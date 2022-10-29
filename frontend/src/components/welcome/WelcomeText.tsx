import React, { FC } from 'react';
import { Button, Row, Typography } from 'antd';
import './WelcomeText.css';

const WelcomeText: FC = () => {
	const { Title } = Typography;
	return (
		<Row justify={'center'} align={'middle'} className={'h100'}>
			<div className={'welcome-block'}>
				<Title>Онлайн конфигуратор ПК</Title>
				<Title level={5} type={'secondary'}>
					Собери сборку своей мечты
				</Title>
				<Button size={'large'} type={'primary'} shape={'round'}>
					Создать свою сборку
				</Button>
			</div>
		</Row>
	);
};

export default WelcomeText;
