import React, { useState } from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import { UserProvider } from "../context/UserContext";
import AuthScreen from "../screens/AuthScreen";
import PassPurchase from "../screens/PassPurchaseScreen";
import MainTabs from "./MainTabs";

const Stack = createNativeStackNavigator();

export default function RootNavigator() {
  const [isAuthenticated, setIsAuthenticated] = useState(false);

  return (
    <UserProvider>
      <NavigationContainer>
        <Stack.Navigator screenOptions={{ headerShown: false }}>
          {isAuthenticated ? (
            <>
            <Stack.Screen name="Main">
              {(props) => <MainTabs {...props} setIsAuthenticated={setIsAuthenticated} />}
            </Stack.Screen>
            <Stack.Screen name="PassPurchase">
              {(props) => <PassPurchase {...props} options={{ headerShown: true }}  />}
            </Stack.Screen>
            </>
          ) : (
            <Stack.Screen name="Auth">
              {(props) => <AuthScreen {...props} setIsAuthenticated={setIsAuthenticated} />}
            </Stack.Screen>
          )}
        </Stack.Navigator>
      </NavigationContainer>
    </UserProvider>
  );
}
