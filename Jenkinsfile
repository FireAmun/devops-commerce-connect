pipeline {
    agent any

    environment {
        ISSUE_KEY = 'SCRUM-2'
    }

    stages {
        stage('Build') {
            steps {
                echo "🔧 Building..."
            }
        }

        stage('Update Jira') {
            steps {
                script {
                    jiraAddComment(
                        site: 'MyJira',
                        idOrKey: "${env.ISSUE_KEY}",
                        comment: "✅ Jenkins build ${env.BUILD_TAG} passed!"
                    )
                    jiraSendBuildInfo(
                        site: 'MyJira',
                        idOrKey: "${env.ISSUE_KEY}"
                    )
                }
            }
        }
    }
}
