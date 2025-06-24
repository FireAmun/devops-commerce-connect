pipeline {
    agent any

    environment {
        ISSUE_KEY = 'SCRUM-2'  // The Jira issue you created
    }

    stages {
        stage('Build') {
            steps {
                echo "Building..."
                // Add your actual build/test steps here
            }
        }

        stage('Update Jira') {
            steps {
                jiraComment (
                    site: 'MyJira',  // This must match the Jira site name in Jenkins config
                    issueKey: "${env.ISSUE_KEY}",
                    body: "✅ Build passed for ${env.BUILD_TAG}"
                )
            }
        }
    }
}
