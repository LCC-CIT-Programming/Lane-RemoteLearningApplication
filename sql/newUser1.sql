-- Create a user named mgs_user
GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO citlab_user@localhost
IDENTIFIED BY 'pa$$word123';