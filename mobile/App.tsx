import React, { useState } from 'react';
import { SafeAreaView, StatusBar, StyleSheet, View } from 'react-native';
import { AuthProvider, useAuth } from './context/AuthContext';
import DashboardScreen from './pages/DashboardScreen';
import LoginScreen from './pages/LoginScreen';
import RegisterScreen from './pages/RegisterScreen';
import MfaScreen from './pages/MfaScreen';

type Screen = 'login' | 'register' | 'mfa';

function AppContent() {
  const { user, loading } = useAuth();
  const [screen, setScreen] = useState<Screen>('login');
  const [pendingEmail, setPendingEmail] = useState('');

  if (loading) {
    return <View style={styles.loadingContainer} />;
  }

  if (user) {
    return <DashboardScreen />;
  }

  if (screen === 'register') {
    return <RegisterScreen onSignIn={() => setScreen('login')} />;
  }

  if (screen === 'mfa') {
    return <MfaScreen email={pendingEmail} onSuccess={() => setScreen('login')} onCancel={() => setScreen('login')} />;
  }

  return (
    <LoginScreen
      onRegister={() => setScreen('register')}
      onMfaRequired={(email) => {
        setPendingEmail(email);
        setScreen('mfa');
      }}
    />
  );
}

export default function App() {
  return (
    <AuthProvider>
      <SafeAreaView style={styles.safeArea}>
        <StatusBar barStyle="dark-content" />
        <View style={styles.container}>
          <AppContent />
        </View>
      </SafeAreaView>
    </AuthProvider>
  );
}

const styles = StyleSheet.create({
  safeArea: {
    flex: 1,
    backgroundColor: '#f8fafc',
  },
  container: {
    flex: 1,
    padding: 20,
    justifyContent: 'center',
  },
  loadingContainer: {
    flex: 1,
    backgroundColor: '#f8fafc',
  },
});
