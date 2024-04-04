create table

CREATE TABLE users(
    user_id INT(11) NOT NULL UNIQUE AUTO_INCREMENT,
    first_name VARCHAR(64) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    password VARCHAR(255),
    email VARCHAR(64) NOT NULL UNIQUE,
    role TINYINT(1) DEFAULT 0,
    verification_token VARCHAR(255),
    email_verfied TINYINT(1) DEFAULT 0,
    contact_number INT(12) DEFAULT NULL,
    created_at date,
    updated_at date,
    department_id INT(11) NOT NULL,
    status TINYINT(1) DEFAULT 0,
    is_admin TINYINT(1) DEFAULT 0,
    PRIMARY KEY(user_id)
);

CREATE TABLE department(
    department_id INT(11) NOT NULL UNIQUE AUTO_INCREMENT,
    department_name VARCHAR(64) NOT NULL,
    admin_id INT(11) NOT NULL,
    status TINYINT(1) DEFAULT 0,
    created_at date,
    updated_at date,
    PRIMARY KEY(department_id),
    FOREIGN KEY(admin_id) REFERENCES users(user_id)
);

CREATE TABLE batch(
    batch_id INT(11) NOT NULL UNIQUE AUTO_INCREMENT,
    department_id INT(11) NOT NULL,
    batch_name VARCHAR(64) NOT NULL,
    status TINYINT(1) DEFAULT 0,
    created_at date,
    updated_at date,
    admin_id INT(11) NOT NULL,
    PRIMARY KEY(batch_id),
    FOREIGN KEY(department_id) REFERENCES department(department_id),
    FOREIGN KEY(admin_id) REFERENCES users(user_id)
);

CREATE TABLE students(
    user_id INT(11) NOT NULL,
    academic_year VARCHAR(64) NOT NULL,
    created_at date,
    updated_at date,
    added_by INT(11) NOT NULL,
    current_year TINYINT(1),
    batch_id INT(11) NOT NULL,
    department_id INT(11) NOT NULL,
    FOREIGN KEY(user_id) REFERENCES users(user_id),
    FOREIGN KEY(added_by) REFERENCES users(user_id),
    FOREIGN KEY(batch_id) REFERENCES batch(batch_id),
    FOREIGN KEY(department_id) REFERENCES department(department_id)
);

CREATE TABLE admin(
    user_id INT(11) NOT NULL, 
    joining_date date,
    years_of_experience INT(3),
    qualifications VARCHAR(1024),
    expertise VARCHAR(1024),
    department_id INT(11) NOT NULL,
    FOREIGN KEY(user_id) REFERENCES users(user_id),
    FOREIGN KEY(department_id) REFERENCES department(department_id)
);

CREATE TABLE events(
    event_id INT(11) NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(64) NOT NULL, 
    event_description VARCHAR(256) NOT NULL,
    organizer_id INT(11) NOT NULL,
    approved_by INT(11) DEFAULT NULL,
    status TINYINT(1) DEFAULT 0,
    allocated_venue VARCHAR(64) DEFAULT NULL,
    added_msg VARCHAR(1024) DEFAULT NULL,
    created_at date,
    updated_at date,
    event_date date NOT NULL,
    event_start_time INT(4) NOT NULL,
    event_end_time INT(4) NOT NULL,
    registration_closing_date date NOT NULL,
    registration_closing_time INT(4) NOT NULL,
    batch_id INT(11) NOT NULL,
    event_link VARCHAR(64) NOT NULL,
    PRIMARY KEY(event_id),
    FOREIGN KEY(organizer_id) REFERENCES users(user_id),
    FOREIGN KEY(approved_by) REFERENCES users(user_id),
    FOREIGN KEY(batch_id) REFERENCES batch(batch_id)
);

CREATE TABLE attendance(
    attendance_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    admin_id INT(11) DEFAULT 0,
    event_id INT(11) NOT NULL,
    batch_id INT(11) NOT NULL,
    is_present TINYINT(1) DEFAULT 0,
    created_at date,
    updated_at date,
    PRIMARY KEY(attendance_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id),
    FOREIGN KEY(admin_id) REFERENCES users(user_id),
    FOREIGN key(event_id) REFERENCES events(event_id),
    FOREIGN KEY(batch_id) REFERENCES batch(batch_id)
);

    CREATE TABLE ratings(
        rating_id INT(11) NOT NULL AUTO_INCREMENT,
        rating TINYINT(3) NOT NULL,
        feedback_msg VARCHAR(256),
        event_id INT(11) NOT NULL,
        user_id INT(11) NOT NULL,
        created_at date,
        updated_at date,
        PRIMARY KEY(rating_id),
        FOREIGN KEY(event_id) REFERENCES events(event_id),
        FOREIGN KEY(user_id) REFERENCES users(user_id)
    );

CREATE TABLE event_attendees_replies(
    reply_id INT(11) NOT NULL AUTO_INCREMENT,
    event_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    link_reply TINYINT(1) DEFAULT 0,
    PRIMARY KEY(reply_id),
    FOREIGN KEY(event_id) REFERENCES events(event_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);

ALTER TABLE `events` CHANGE `event_start_time` `event_start_time` VARCHAR(10) NOT NULL;
ALTER TABLE `events` CHANGE `event_end_time` `event_end_time` VARCHAR(10) NOT NULL;
ALTER TABLE `events` CHANGE `registration_closing_time` `registration_closing_time` VARCHAR(10) NOT NULL;