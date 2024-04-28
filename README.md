erDiagram
    USER ||--o{ ACCOUNTS : "has"
    USER ||--o{ FINANCIALTRONPURCHASE : "records"
    USER ||--o{ FINANCIALTRONRENTAL : "records"
    USER ||--o{ PURCHASES : "makes"
    USER ||--o{ RENTALS : "makes"
    USER {
        string username PK
        string password
        string email
        string accessLevel
    }

    CUSTOMERS ||--o{ ACCOUNTS : "has"
    CUSTOMERS ||--o{ PURCHASES : "makes"
    CUSTOMERS ||--o{ RENTALS : "makes"
    CUSTOMERS {
        int customerID PK
        string firstName
        string lastName
        string address
        string phone
        string email
        blob photo
        char gender
        date memberSince
    }

    ACCOUNTS ||--o{ FINANCIALTRONPURCHASE : "relates"
    ACCOUNTS ||--o{ FINANCIALTRONRENTAL : "relates"
    ACCOUNTS {
        int accountID PK
        string accountName UNIQUE
        string accountDetails
        int Customers_customerID FK
        string User_username FK
        string payMethod
    }

    FINANCIALTRONPURCHASE }|--|| TRTYPECODE : "uses"
    FINANCIALTRONPURCHASE }|--|| PURCHASES : "relates"
    FINANCIALTRONPURCHASE {
        int trID PK
        date trDate
        int Accounts_accountID FK
        string TrTypeCode_trTypeCode FK
        int Purchases_purchaseID FK
        string User_username FK
    }

    FINANCIALTRONRENTAL }|--|| TRTYPECODE : "uses"
    FINANCIALTRONRENTAL }|--|| RENTALS : "relates"
    FINANCIALTRONRENTAL {
        int trID PK
        date trDate
        int Accounts_accountID FK
        int Rentals_rentalID FK
        string TrTypeCode_trTypeCode FK
        string User_username FK
    }

    ITEM ||--o{ PURCHASES : "involves"
    ITEM ||--o{ RENTALS : "involves"
    ITEM ||--|| ITEMTYPE : "categorized"
    ITEM {
        int itemID PK
        string itemName
        int stock
        string rentalOrSale
        int salePrice
        int rentRate
        blob photo
        int ItemType_itemTypeId FK
    }

    ITEMTYPE {
        int itemTypeId PK
        string typeName
    }

    PURCHASES {
        int purchaseID PK
        date purchaseDate
        int purchaseQuantity
        int amountDue
        string User_username FK
        int Item_itemID FK
        int Customers_customerID FK
        int payAmount
    }

    RENTALS {
        int rentalID PK
        date rentalDate
        date returnDate
        string paid
        int amountDue
        string User_username FK
        int Item_itemID FK
        int Customers_customerID FK
    }

    TRTYPECODE {
        string trTypeCode PK
        string typeDescription
    }
