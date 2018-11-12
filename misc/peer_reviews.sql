create table instructors
(
  InstructorID int not null auto_increment,
  FirstName varchar(255) not null,
  LastName varchar(255) not null,
  Email varchar(255) not null,
  Password varchar(255) not null,
  PRIMARY KEY(InstructorID),
  UNIQUE(Email)
);

create table groups
(
  GroupID int not null AUTO_INCREMENT,
  ProjectName varchar(255) not null,
  ProjectDescription varchar(255) not null,
  LeaderEmail varchar(255) not null,
  PRIMARY KEY(GroupID),
  UNIQUE(LeaderEmail)
);

create table students
(
  StudentID int not null AUTO_INCREMENT,
  FirstName varchar(255) not null,
  LastName varchar(255) not null,
  Email varchar(255) not null,
  Password varchar(255) not null,
  GroupID int,
  PRIMARY KEY(StudentID),
  FOREIGN KEY(GroupID) REFERENCES groups(GroupID),
  UNIQUE(Email)
);

create table evaluations
(
  EvaluationID int not null AUTO_INCREMENT,
  CourseID varchar(255) not null,
  CourseTitle varchar(255) not null,
  Section int not null,
  Semester varchar(7) not null,
  Year int not null,
  InstructorID int not null,
  PRIMARY KEY(EvaluationID),
  FOREIGN KEY(InstructorID) REFERENCES instructors(InstructorID)
);

create table grades
(
  GradeID int not null AUTO_INCREMENT,
  Participation int not null,
  Contribution int not null,
  Attendance int not null,
  Supportiveness int not null,
  Communication int not null,
  StudentID int not null,
  GraderID int not null,
  EvaluationID int not null,
  PRIMARY KEY(GradeID),
  FOREIGN KEY (StudentID) REFERENCES students(StudentID),
  FOREIGN KEY (GraderID) REFERENCES students(StudentID),
  FOREIGN KEY (EvaluationID) REFERENCES evaluations(EvaluationID)
);

create table gradecriteria
(
  Title varchar(255) not null,
  Description varchar(255) not null,
  Weight decimal(3, 2) not null,
  PRIMARY KEY(Title)
);

insert into instructors
values (NULL, "Logan", "Baker", "lbaker38@kent.edu", "Logan123");

insert into students
values (NULL, "John", "Doe", "johndoe@kent.edu", "Doe123", NULL);

insert into students
values (NULL, "Jane", "Doe", "janedoe@kent.edu", "Doe123", NULL);

insert into students
values (NULL, "Dan", "Doe", "dandoe@kent.edu", "Doe123", NULL);

insert into students
values (NULL, "Jan", "Doe", "jandoe@kent.edu", "Doe123", NULL);

insert into students
values (NULL, "Tahn", "Doe", "tahndoe@kent.edu", "Doe123", NULL);

insert into groups 
values (NULL, "Test Project", "This is a test project.", "johndoe@kent.edu");

insert into gradecriteria
values ("Participation", "Did he/she participate in group conversation?", 0.25);

insert into evaluations
values (NULL, "CS-101", "Intro to Databases", 001, "Fall", 2018, 1);