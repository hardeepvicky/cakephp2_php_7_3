<?php
class ViewWebServiceLog extends AppModel
{
    public $web_service_types = array(
        WS_LOGIN => "Login",
        WS_LOGIN_SIMPLE => "Login Simple",
        WS_LOGOUT => "Log Out",
        WS_CHECK_ATTENDANCE_DEVICE => "Attendance Check Device",
        WS_CHANGE_PASSWORD => "Change Password",
        WS_FORGOT_PASSWORD => "Forgot Password",
        WS_GCM_REG => "GCM Registration",
        WS_GET_MASTERS => "Get Masters",
        WS_SAVE_EMPLOYEE => "User Save",
        WS_SAVE_USER_DOC_IMAGES => "User Document Save",
        WS_GET_USER_DETAIL_LIST => "Attendance Get User Detail List",
        WS_CHANGE_WORKING_STATUS => "Attendance Change User Working Status",
        WS_ATTENDANCE_BY_FINGERPRINT => "Attendance By Fingerprint",
        WS_ATTENDANCE_BY_USERNAME => "Attendance By Username",
        WS_GET_ATTENDANCES => "Attendance Get",
        WS_SAVE_USER_FINGERPRINT => "Save User Fingerprint",
        WS_GET_ATTENDANCE_OVERVIEW => "Attendance Get Overview",
        WS_GET_ACTIVITY_LOG => "Attendance Get Activity Log",
        WS_SAVE_WATCH_LIST => "Attendance Save Watch List",
        WS_ATTENDANCE_STATUS_CONFIRM => "Attendance Status Confirm",

        WS_TASK_GET_MASTER => "Task Get Master",            
        WS_TASK_GET_ASSIGNED_TASK => "Task Get Assigned Task",
        WS_TASK_GET_MY_TASK => "Task Get My Task",
        WS_TASK_GET_TASK => "Task Get",
        WS_TASK_GET_TASK_TREE => "Task Get Task Tree",
        WS_TASK_SAVE_TASK => "Task Save",
        WS_TASK_DELETE => "Task Delete",
        WS_TASK_SAVE_TASK_IMAGE => "Task Save Image",
        WS_TASK_DELETE_IMAGE => "Task Delete Image",
        WS_TASK_COMPLETE => "Task Complete",
        WS_TASK_VERIFY => "Task Verify",
        WS_TASK_REQUEST_FOR_MODIFICATION => "Task Request for Modification",
        WS_TASK_SAVE_COMMENT => "Task Commnent Save",
        WS_TASK_GET_COMMENT => "Task Commnent Get",
        WS_TASK_DELETE_COMMENT => "Task Commnent Delete",
        WS_TASK_DASHBOARD => "Task Dashboard",

        WS_SAVE_ACTIVITY => "Save Activity",
        WS_GET_IMAGES => "Image Get",
        WS_SAVE_IMAGE => "Image Save",
        WS_DELETE_IMAGE => "Image Delete",

        WS_NOTIFICATION_GET => "Notification Get",

        WS_LEGDER_GET_PAYMENTS => "Ledger Get Payments",
        WS_LEGDER_GET_RECIEPTS => "Ledger Get Reciepts",
        WS_LEGDER_GET_EXPENSES => "Ledger Get Expenses",
        WS_LEGDER_GET_SALES => "Ledger Get Sales",
        WS_LEGDER_GET_LEGDER_TRANSACTIONS => "Ledger Get Transactions",
        WS_LEGDER_GET_PENDING_TRANSACTIONS => "Legder Get Pending Transactions",
        WS_LEGDER_GET_MY_PENDING_TRANSACTIONS => "Legder Get My Pending Transactions",
        WS_LEGDER_SAVE_PAYMENT => "Ledger Save Payment",
        WS_LEGDER_SAVE_RECIEPT => "Ledger Save Reciept",
        WS_LEGDER_SAVE_EXPENSE => "Ledger Save Expense",
        WS_LEGDER_SAVE_EXPENSE_IMAGES => "Legder Expense Image Save",
        WS_LEGDER_SAVE_SALE => "Ledger Save Sale",
        WS_LEGDER_SAVE_SALE_IMAGES => "Legder Sale Image Save",
        WS_LEGDER_DELETE_PAYMENT => "Ledger Delete Payment",
        WS_LEGDER_DELETE_RECIEPT => "Ledger Delete Reciept",
        WS_LEGDER_DELETE_EXPENSE => "Ledger Delete Expense",
        WS_LEGDER_DELETE_SALE => "Ledger Delete Sale",
        WS_LEGDER_VERIFY_PAYMENT => "Ledger Verify Payment",
        WS_LEGDER_VERIFY_RECIEPT => "Ledger Verify Reciept",
        WS_LEGDER_VERIFY_EXPENSE => "Ledger Verify Expense",
        WS_LEGDER_VERIFY_SALE => "Ledger Verify Sale",
        WS_LEGDER_REPORT => "Legder Report",
        
        WS_GET_INVENTORY_DETAIL => "Inventory Get Detail",
        WS_GET_INVOICES_FOR_SALE => "Get Invoices For Sale",
        WS_GET_INVOICES_FOR_EXPENSE => "Get Invoices For Expense",

        WS_SAVE_ITEM => "Item Save",

        WS_AMAZON_ORDER_SAVE_CUSTOMER_INFO => "Party Order Save Customer Info",
        WS_PARTY_GET_DATA => "Party Get Data",

        WS_MANUFACTURE_SCAN_CODE => "Manufacture Scan Code",
        WS_MANUFACTURE_SCAN_INFO => "Manufacture Scan Info",
        WS_MANUFACTURE_CHANGE_PROCESS_STATE => "Manufacture Change Process State",
        WS_MANUFACTURE_DELETE_SERIAL_CODE => "Manufacture Delete Serial Code",
        WS_MANUFACTURE_BBSC_SAVE_DETAILS => "Manufacture Serail Code Save Detail",
        WS_USER_OPERATION_TYPES_GET => "User Get Operation Types",
        WS_USER_LOCATION_GET => "User Get Locations",

        WS_MANUFACTURE_ORDER_GET => "Manufacture Order Get",
        WS_MANUFACTURE_ORDER_GET_DETAIL => "Manufacture Order Get Detail",
        WS_MANUFACTURE_ORDER_CUT_SAVE => "Manufacture Order Cut Save",
        WS_MANUFACTURE_ORDER_CUT_GET => "Manufacture Order Cut Get",
        WS_MANUFACTURE_ORDER_CUT_DELETE => "Manufacture Order Cut Delete",
        WS_MANUFACTURE_ORDER_CUT_FABRIC_ESTIMATION_SAVE => "Manufacture Order Fabric Estimation Save",
        WS_MANUFACTURE_ORDER_GET_PREVIOUS_FABRIC_ESTIMATION => "Manufacture Order Get Previous fabric estimation",        
        WS_MANUFACTURE_ORDER_CUT_LAYER_SAVE => "Manufacture Order Cut Layer Save",        
        WS_MANUFACTURE_ORDER_CUT_LAYER_GET => "Manufacture Order Cut Layer Get",
        WS_MANUFACTURE_ORDER_CUT_LAYER_DELETE => "Manufacture Order Cut Layer Delete",
        WS_MANUFACTURE_ORDER_CUT_LAYER_BLOCK_SAVE => "Manufacture Order Layer block save",
        WS_MANUFACTURE_ORDER_CUT_LAYER_BLOCK_DELETE => "Manufacture Order Layer block Delete",
        WS_MANUFACTURE_ORDER_CUT_LAYER_BLOCK_GET => "Manufacture Order Layer block Get",
        WS_MANUFACTURE_ORDER_PICK_TOGGLE => "Manufacture Order Pick Toggle",
        WS_MANUFACTURE_ORDER_GET_DATA_FOR_BUNDLE_CREATE => "Manufacture Order Get Data for Bundle Create",
        WS_MANUFACTURE_ORDER_BUNDLE_SAVE => "Manufacture Order Bundle Save",
        WS_MANUFACTURE_ORDER_BUNDLE_GET => "Manufacture Order Bundle Get",
        WS_MANUFACTURE_ORDER_BUNDLE_DELETE => "Manufacture Order Bundle Delete",
        WS_MANUFACTURE_ORDER_SEND_NOTI_FOR_CHECK => "Manufacture Order Noti For Check",
        WS_MANUFACTURE_CUT_NAME_GET => "Manufacture Cut Name Get",
        WS_MANUFACTURE_CUT_NAME_SAVE => "Manufacture Cut Name Save",
        
        WS_BATCH_BUNDLE_ASSIGN_SAVE => "Batch Bundle Assign Save",
        WS_BATCH_BUNDLE_ASSIGN_SUMMARY => "Batch Bundle Assign Summary",
        WS_BATCH_BUNDLE_ASSIGN_DELETE => "Batch Bundle Assign Delete",
        
        WS_MANUFACTURE_ORDER_EXTRA_CUT_GET => "Manufacture Order Extra Cut Get",
        WS_MANUFACTURE_ORDER_EXTRA_CUT_SAVE => "Manufacture Order Extra Cut Save",
        WS_MANUFACTURE_ORDER_EXTRA_CUT_DELETE => "Manufacture Order Extra Cut Delete",
        WS_GET_SIZE_TYPE_LIST_FROM_PRODUCT_GROUP_ID => "Get Size List From Product Group Id",        
        WS_MANUFACTURE_ORDER_GET_STYLE_LIST => "Manufacture Order Get Product Group",        

        WS_PRODUCT_STYLE_COLOR_SIZE_GET => "Product Style Color Size Get",
        WS_PRODUCT_CONSUMPTION_GET => "Product Consumption Get",
        WS_PRODUCT_CONSUMPTION_SAVE => "Product Consumption Save",
        WS_GET_SUB_LOCATIONS_OF_PRODUCT => "Get Sub Locations of Product",
        WS_OPEN_SUB_LOCATION_GET => "Get Open Sub Locations",
        WS_PRODUCT_CONSUMPTION_OPERATION_TYPE_FOR_RETURN => "Product Consumption Operation Type For Return",

        WS_GLOW_GET_INFO => "Glow Road Get Info",        
        WS_GLOWROAD_NEW_ORDER => "Glow Road New Order",
        WS_GLOWROAD_MANIFEST_ORDER => "Glow Road Manifest Order",
        WS_GLOWROAD_DELIVERED_ORDER => "Glow Road Delivered Order",
        WS_GLOWROAD_CANCEL_ORDER => "Glow Road Cancel Order",
        WS_GLOWROAD_RETURN_ORDER => "Glow Road Return Order",
        WS_GLOWROAD_SHIP_ORDER => "Glow Road Ship Order",
        WS_GLOWROAD_PAYMENT_SAVE => "Glow Road Payment Save",
        
        WS_MEESHO_NEW_ORDERS => "Meesho New Order",
        WS_MEESHO_TO_BE_DISPATCH_ORDERS => "Meesho To Be Dispatch Orders",
        WS_MEESHO_READY_TO_DISPATCH_ORDERS => "Meesho Ready To Dispatch Orders",
        
        WS_MEESHO_SHIP_ORDERS => "Meesho Ship Order",
        WS_MEESHO_CANCEL_ORDERS => "Meesho Cancel Order",
        WS_MEESHO_RETURN_OR_DELIVER_ORDERS => "Meesho Return Or Delivered Order",
        
        WS_MEESHO_EXCHANGE_NEW_ORDERS => "Meesho Exchange New Orders",
        WS_MEESHO_EXCHANGE_TO_BE_DISPATCH_ORDERS => "Meesho Exchange To Be Dispatch Orders",
        WS_MEESHO_EXCHANGE_READY_TO_DISPATCH_ORDERS => "Meesho Exchange Ready To Dispatch Orders",
        
        WS_MEESHO_INVENTORY_SAVE => "Meesho Inventory Save",
        
        WS_CLUB_FACTORY_ORDER_SAVE => "Club Factory Order Save",
        WS_CLUB_FACTORY_RETURN_ORDER_SAVE => "Club Factory Return Order Save",
        WS_CLUB_FACTORY_INVENTORY_SAVE => "Club Factory Inventory Save",
        
        WS_FLIPKART_INVENTORY_SAVE => "Flipkart Inventory Save",
        
        WS_PRODUCT_THRESHOLD => "Product Threshold",
        WS_ANNOUNCEMENT_GET => "Announcement Get",
        WS_ANNOUNCEMENT_SEEN => "Announcement Seen",
        
        WS_PRODUCT_OPERATION => "Product Operation Get",
        WS_SERIAL_CODE_OVERVIEW => "Serial Code Overview",
        WS_SERIAL_CODE_DAMAGE_SAVE => "Serial Code Damage Save",
        
        WS_GET_PRODUCT_ID_BY_CODE => "Get Product Id By Code",
        
        WS_SUB_LOCATION_GET => "Sub Location Get",
        WS_INVENTORY_SCANABLE_SUB_LOCATION_TRANSFER => "Inventory Scanable Sub Location Transfer",        
        WS_INVENTORY_SCANABLE_GET_INVOICES => "Inventory Get Invoices",
        WS_INVENTORY_SCANABLE_INCOMING_SAVE => "Inventory Scanable Incoming Save",
        WS_INVENTORY_SCANABLE_OUTGOING_SAVE => "Inventory Scanable Outgoing Save",
        WS_INVENTORY_SCANABLE_REFFER_INCOMING_SAVE => "Inventory Scanable Reffer Incoming Save",
        WS_INVENTORY_SCANABLE_REFFER_OUTGOING_SAVE => "Inventory Scanable Reffer Outgoing Save",
        WS_INVENTORY_SCANABLE_STOCK_TRANSFER_INCOMING_SAVE => "Inventory Scanable Stock Transfer Incoming Save",
        WS_INVENTORY_SCANABLE_STOCK_TRANSFER_OUTGOING_SAVE => "Inventory Scanable Stock Transfer Outgoing Save",
        WS_INVENTORY_SCANABLE_GET_SUB_LOCATIONS => "Inventory Scanable Get Sub Locations",
        
        WS_BATCH_BUNDLE_SAVE => "Batch Bundle Save",
        WS_PRODUCT_GROUP_GET => "Product Group Get",
        WS_PRODUCT_GROUP_DETAIL_GET => "Product Group Detail Get",
        
        WS_CHROME_EXT_WILL_RUN => "Chrome Extension Will Run",
        WS_CHROME_EXT_FINISH => "Chrome Extension Finish",
        
        WS_MANUFACTURE_TARGET => "Manufacture Target",
        WS_GET_USER_LIST => "Get User List",
        
        WS_GET_SERIAL_CODE_DETAIL => "Get Serial Code Detail",
        
        WS_POST_INTERVIEW => "Post Interview",
        
        WS_GET_MANUFACTURE_TARGET => "Get Manufacture Target",
        
        WS_LEGDER_SALARY_GET => "Ledger Salary Get",
        WS_LEGDER_SALARY_RECEIVED => "Ledger Salary Receieved",
    );
}
