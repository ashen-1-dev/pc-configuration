import React, {FC, useContext, useState} from 'react';
import {Button, Col, Form, Image, Input, Row, Typography, Upload} from "antd";
import {UserContext} from "../../App";
import MainLayout from "../../layouts/MainLayout";
import {useNavigate} from "react-router-dom";
import {RouteNames} from "../../router";
import {GetUserDto} from "../../models/user/get-user.dto";
import {useMutation} from "@tanstack/react-query";
import UserService from "../../services/user/UserService";
import {UpdateUserDto} from "../../models/user/update-user.dto";
import {dummyRequest} from "../../utils/request";
import {UploadOutlined} from "@ant-design/icons";

const UserProfile: FC = () => {
	const user = useContext(UserContext);
	const [buttonActive, setButtonActive] = useState(false);
	const navigate = useNavigate();

	const {mutate: updateUser} = useMutation({
		mutationKey: ['update user'],
		mutationFn: UserService.updateUser,
	})


	const onFormChange = (data: GetUserDto) => {
		setButtonActive(true);
	}

	const onUserUpdateFormSubmit = (data: UpdateUserDto) => {
		updateUser(data);
		setButtonActive(false);
		navigate(0);
	}

	if (!user)
		return <div>Загрузка...</div>
	return (
		<MainLayout>
			<Row justify={'center'}><Typography.Title>Профиль пользователя</Typography.Title></Row>
			<Row justify={'space-evenly'} style={{padding: '10vh 20vw'}}>
				<Col>
					<Form
						initialValues={user}
						onFinish={onUserUpdateFormSubmit}
						onValuesChange={onFormChange}
					>
						<div>
							<Typography.Title level={4}>Имя</Typography.Title>
							<Form.Item
								name={'firstName'}
							>
								<Input/>
							</Form.Item>
						</div>
						<div>
							<Typography.Title level={4}>Фамилия</Typography.Title>
							<Form.Item
								name={'lastName'}
							>
								<Input/>
							</Form.Item>
						</div>
						<div>
							<Typography.Title level={4}>Почта</Typography.Title>
							<Form.Item
								name={'email'}
							>
								<Input/>
							</Form.Item>
						</div>
						<div>
							<Typography.Title level={4}>Изменить фото</Typography.Title>
							<Form.Item
								name={'photo'}
								getValueFromEvent={({file}) => file.originFileObj}
							>
								<Upload
									maxCount={1}
									accept={'image/*'}
									listType="picture"
									//@ts-expect-error
									customRequest={dummyRequest}
								>
									<Button icon={<UploadOutlined/>}>Загрузить</Button>
								</Upload>
							</Form.Item>
						</div>
						<Form.Item>
							<Button disabled={!buttonActive} type="primary" htmlType="submit">
								Сохранить
							</Button>
						</Form.Item>
					</Form>
				</Col>
				<Col>
					<Row>
						<Image style={{borderRadius: '50px'}} width={200} height={200} src={user.photoUrl}/>
					</Row>
					<Row justify={'center'}>
						<Button onClick={() => onUserUpdateFormSubmit({photo: null})}>Удалить</Button>
					</Row>
				</Col>
			</Row>
			<Row justify={'center'}>
				<Button onClick={() => navigate(RouteNames.MYBUILDS)} type={'primary'} shape={'round'} size={'large'}>
					<Typography.Title level={4}>Посмотреть мои сборки</Typography.Title>
				</Button>
			</Row>
		</MainLayout>
	);

};

export default UserProfile;