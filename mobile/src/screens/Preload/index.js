import React, { useEffect, useContext } from 'react';
import { Container, LoadingIcon } from './styles';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';
import { Image } from 'react-native';

import { UserContext } from '../../contexts/UserContext';

import Api from '../../Api';

//import PreloadMedico from '../../assets/preload.svg';
export default () => {

    const { dispatch: userDispatch } = useContext(UserContext);
    const navigation = useNavigation();

    useEffect(() => {
        const checkToken = async () => {

            const token = await AsyncStorage.getItem('token');

            if (token) {
                let res = await Api.checkToken(token);

                if (res.token) {

                    await AsyncStorage.setItem('token', res.token);

                    userDispatch({
                        type: 'setAvatar',
                        payload: {
                            avatar: res.data.avatar
                        }
                    });

                    navigation.reset({
                        routes: [{ name: 'MainTab' }]
                    });

                } else {
                    navigation.navigate('SignIn');
                }

            } else {
                navigation.navigate('SignIn');
            }
        }
        checkToken();
    }, []);

    return (
        <Container>
            <Image

                source={require('../../assets/logo.png')}
            />

            <LoadingIcon size="large" color="#ffffff" />
        </Container>
    )
}