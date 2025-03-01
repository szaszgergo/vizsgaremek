import React, { createContext, useState, useEffect } from "react";
import AsyncStorage from "@react-native-async-storage/async-storage";

export const UserContext = createContext();

export const UserProvider = ({ children }) => {
    const [userData, setUserData] = useState(null);
    const [loading, setLoading] = useState(true);

    const fetchUserData = async () => {
        try {
            const uID = await AsyncStorage.getItem("uID");
            if (!uID) return;
            const response = await fetch(`http://liftzone.hu/api/useradatok/?uid=${uID}`);
            const result = await response.json();
            setUserData(result.data);
            console.log("User data fetched", result.data);
        } catch (error) {
            console.error("Failed to fetch user data", error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchUserData();
    }, []);

    return (
        <UserContext.Provider value={{ userData, setUserData, loading, fetchUserData }}>
            {children}
        </UserContext.Provider>
    );
};
