import React, { FC, useEffect, useState } from 'react';
import MainLayout from '../../layouts/MainLayout';
import ComponentList from '../../components/component/component-list/ComponentList';
import CreateComponentForm from '../../components/component/form/CreateComponentForm';
import { Button, Col, Form, Modal, Row } from 'antd';
import { useQuery } from '@tanstack/react-query';
import ComponentService from '../../services/component/ComponentService';
import ComponentSearch from '../../components/component/component-list/ComponentSearch';
import { ComponentQuery } from '../../services/component/component-query';
import useDebounce from '../../hooks/useDebounce';

const Component: FC = () => {
	const [isModalOpen, setIsModalOpen] = useState<boolean>(false);
	const [query, setQuery] = useState<ComponentQuery>({});
	const { data: components, refetch } = useQuery({
		queryKey: ['components'],
		queryFn: async () => await ComponentService.getComponents(query),
	});
	const debouncedQuery = useDebounce(query, 400);

	useEffect(() => {
		refetch();
	}, [debouncedQuery]);

	const onQueryChange = (query: Partial<ComponentQuery>) => {
		setQuery(prevState => ({ ...prevState, ...query }));
	};

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
				<ComponentSearch onQueryChange={onQueryChange} />
			</Row>
			<Row justify={'center'} style={{ marginTop: '40px' }}>
				<Button onClick={showModal}>Создать компонент</Button>
			</Row>
			<Row justify={'center'} style={{ paddingTop: '30px' }}>
				<Col span={12}>
					<ComponentList components={components} />
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
