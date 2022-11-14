import React, { FC, useState } from 'react';
import MainLayout from '../../layouts/MainLayout';
import ComponentList from '../../components/component/component-list/ComponentList';
import CreateComponentForm from '../../components/component/form/CreateComponentForm';
import { Button, Col, Form, Modal, Row } from 'antd';

const Component: FC = () => {
	const [isModalOpen, setIsModalOpen] = useState<boolean>(false);
	const [form] = Form.useForm();

	const showModal = () => {
		setIsModalOpen(true);
	};

	const handleOk = () => {
		form.submit();
	};

	const handleCancel = () => {
		setIsModalOpen(false);
	};

	return (
		<MainLayout>
			<Row justify={'center'} style={{ marginTop: '40px' }}>
				<Button onClick={showModal}>Создать компонент</Button>
			</Row>
			<Row justify={'center'} style={{ paddingTop: '30px' }}>
				<Col span={12}>
					<ComponentList />
					<Modal
						title="Создать новый компонент"
						open={isModalOpen}
						onOk={handleOk}
						onCancel={handleCancel}
					>
						<CreateComponentForm
							onSuccess={() => setIsModalOpen(false)}
							form={form}
						/>
					</Modal>
				</Col>
			</Row>
		</MainLayout>
	);
};

export default Component;
