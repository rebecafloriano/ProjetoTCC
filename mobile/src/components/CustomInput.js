import React from 'react';
import styled from 'styled-components/native';

const Area = styled.View`
    background-color: #83d6e3;
    width: 100%;
    height: 60px;
    flex-direction: row;
    border-radius: 30px;
    padding-left: 15px;
    align-items: center;
    margin-bottom: 15px;
`;

const InputArea = styled.TextInput`
    flex: 1;
    font-size: 16px;
    color: #268596;
    margin-left: 10px;
`;

export default function CustomInput({
    iconSvg: Icon,
    placeholder = '',
    value,
    onChangeText,
    secureTextEntry = false,
    keyboardType = 'default',
}) {
    return (
        <Area>
            <Icon width="24" height="24" fill="#268596" />
            <InputArea
                placeholder={placeholder}
                placeholderTextColor="#268596"
                value={value}
                onChangeText={onChangeText}
                secureTextEntry={secureTextEntry}
                keyboardType={keyboardType}
            />
        </Area>
    );
}

