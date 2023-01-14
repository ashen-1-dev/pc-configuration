import { useContext } from 'react';
import { UserContext } from '../App';

export const useAuth = () => useContext(UserContext);
