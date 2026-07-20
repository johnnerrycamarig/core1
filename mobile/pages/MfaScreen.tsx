import React, { useState } from 'react';
import { Alert, Button, Text, TextInput, TouchableOpacity, View } from 'react-native';
import { useAuth } from '../context/AuthContext';

interface Props {
  email: string;
  onSuccess: () => void;
  onCancel: () => void;
}

export default function MfaScreen({ email, onSuccess, onCancel }: Props) {
  const { verifyMfa } = useAuth();
  const [code, setCode] = useState('');
  const [loading, setLoading] = useState(false);

  const handleVerify = async () => {
    setLoading(true);
    try {
      await verifyMfa(email, code);
      onSuccess();
    } catch (error: any) {
      Alert.alert('Verification failed', error.message || 'Unable to verify code');
    } finally {
      setLoading(false);
    }
  };

  return (
    <View style={{ width: '100%' }}>
      <Text style={{ fontSize: 28, fontWeight: '700', marginBottom: 12 }}>Multi-factor authentication</Text>
      <Text style={{ color: '#64748b', marginBottom: 24 }}>
        Enter the verification code sent to {email || 'your email'}.
      </Text>

      <Text style={{ marginBottom: 8, color: '#334155' }}>Verification code</Text>
      <TextInput
        value={code}
        onChangeText={setCode}
        keyboardType="number-pad"
        style={{
          borderColor: '#cbd5e1',
          borderWidth: 1,
          borderRadius: 16,
          padding: 14,
          marginBottom: 24,
          backgroundColor: '#fff',
        }}
      />

      <Button title={loading ? 'Verifying…' : 'Verify code'} onPress={handleVerify} disabled={loading} />

      <TouchableOpacity onPress={onCancel} style={{ marginTop: 16 }}>
        <Text style={{ color: '#2563eb', textAlign: 'center' }}>Back to login</Text>
      </TouchableOpacity>
    </View>
  );
}
