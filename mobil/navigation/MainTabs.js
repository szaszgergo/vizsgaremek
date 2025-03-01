import React from "react";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import HomeScreen from "../screens/HomeScreen";
import PassesScreen from "../screens/PassesScreen";
import InfoScreen from "../screens/InfoScreen";
import { Ionicons } from "@expo/vector-icons";

const Tab = createBottomTabNavigator();

export default function MainTabs({ setIsAuthenticated }) {
  return (
    <Tab.Navigator screenOptions={{
        headerShown: true,
        headerTitle: "",
        headerStatusBarHeight: 0,
        tabBarStyle: { backgroundColor: "#333" },
        tabBarLabelStyle: { color: "#faa61ae8", fontSize: 12},
        tabBarActiveTintColor: "#faa61ae8",
        tabBarInactiveTintColor: "#aaa",
      }}>
      <Tab.Screen
        name="Jegy"
        component={HomeScreen}
        options={{ tabBarIcon: ({ color, size }) => <Ionicons name="ticket" color={color} size={size} /> }}
      />
      <Tab.Screen
        name="Jegyek"
        component={PassesScreen}
        options={{ tabBarIcon: ({ color, size }) => <Ionicons name="wallet" color={color} size={size} /> }}
      />
      <Tab.Screen name="Info"
      options={{ tabBarIcon: ({ color, size }) => <Ionicons name="information-circle" color={color} size={size} /> }}>
        {(props) => <InfoScreen {...props} setIsAuthenticated={setIsAuthenticated} />}
      </Tab.Screen>
    </Tab.Navigator>
  );
}
